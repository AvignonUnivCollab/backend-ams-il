<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Laravel ams-il",
 *      description="Documentation de l'API avec Swagger",
 *      @OA\Contact(
 *          email="nkeoualionel@gmail.com"
 *      )
 * )
 *
 * @OA\Server(
 *      url="http://127.0.0.1:8000/api",
 *      description="Serveur local"
 * )
 */
class AuthController extends BaseController
{
    //

    /**
     * Register a new user.
     */
    /**
     * @OA\Post(
     *      path="/register",
     *      summary="Créer un compte utilisateur",
     *      tags={"Authentification"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name","username","email","password"},
     *              @OA\Property(property="name", type="string", example="John Doe"),
     *              @OA\Property(property="username", type="string", example="johndoe"),
     *              @OA\Property(property="email", type="string", example="john@example.com"),
     *              @OA\Property(property="password", type="string", format="password", example="123456")
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Utilisateur créé avec succès",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="User registered successfully."),
     *              @OA\Property(property="data", type="object")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Error"
     *      )
     * )
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'username' => 'required|string|max:30|unique:users',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'in:user,admin,moderator',
        ]);

        if ($validator->fails()) {
            return $this
                ->sendError(
                    'Validation Error',
                    $validator->errors(),
                    422
                );
        }

        $role = $request->input('role', 'user');

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $role,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $token = JWTAuth::fromUser($user);

        return $this->sendResponse([
            'token' => $token,
            'user' => $user,
        ], 'user register successfully');
    }

    /**
     *  login user and return token
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->sendError(
                'Unauthorized',
                401
            );
        }

        $user = Auth::user();
        $token = JWTAuth::fromUser($user);

        return $this->sendResponse([
            'token' => $token,
            'user' => $user,
        ], 'User logged in successfully');
    }


    /**
     * Logout user and invalidate token.
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return $this->sendResponse([], 'User logged out successfully.');
        } catch (JWTException $e) {
            return $this->sendError('Logout failed', [], 500);
        }
    }

    public function me(Request $request)
    {
        $user = $this->authenticate($request);

        if (!$user) {
            return $this->sendError(
                'Unauthorised.',
                401
            );
        }

        return $this->sendResponse([
            'user' => $user,
        ], 'User retrieved successfully.');
    }


    public function checkEmail(Request $request)
    {
        $request->validate([
            "email" => "required|email",
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->sendError(
                'User not found',
                [],
                404
            );
        }

        return $this->sendResponse(['user' => $user], 'user exists');
    }


    public function changePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found',
        ], 404);
    }

    $user->password = bcrypt($request->password);
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'Password updated successfully',
    ]);
}

}
