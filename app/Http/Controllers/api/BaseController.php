<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class BaseController extends Controller
{
    //
    /**
     * Success response method.
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($data, $message = 'success', $code = 200)
    {
        return response()
            ->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $code);
    }


    /**
     * Error response method.
     *
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404) {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function authenticate(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return $this->sendError('Token not provided.', 401);
        }

        $user = JWTAuth::setToken($token)->authenticate();

        if (!$user) {
            return $this->sendError('Unauthorised.', 401);
        }

        return $user;
    }

}
