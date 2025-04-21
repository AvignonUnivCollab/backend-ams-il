<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function index()
    {
        $users = DB::table('users')->orderByDesc('created_at')->get()->map(function ($user) {
            $user->days_since_creation = Carbon::parse($user->created_at)->diffInDays(Carbon::now());
            $user->days_last_connection = Carbon::parse($user->updated_at)->diffInDays(Carbon::now());
            return $user;
        });

        return view('pages.user', compact('users'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin,moderator',
        ]);


        DB::table('users')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return redirect()->route('pages.user')->with('success', 'Utilisateur crée avec success');
    }




    public function update(Request $request, $id) {

        $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:users,username,' . $id,
            'email' => 'required|string|email|max:50|unique:users,email,' . $id,
            'role' => 'required|in:user,admin,moderator',
        ]);

        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
                'updated_at' => now()
            ]);

        return redirect()->route('pages.user')->with('success', 'Utilisateur modifier avec success');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);


        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            //Authentification reussie
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Connection réussie !.');
        }

        return back()->withErrors([
            'password' => 'Mot de passe incorrect'
        ])->withInput();
    }


    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('dashboard')->with('success', 'Déconnexion réussie !');
    }
}
