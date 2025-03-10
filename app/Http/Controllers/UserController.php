<?php

namespace App\Http\Controllers;

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
            return $user;
        });

        return view('pages.user', compact('users'));
    }


    public function show($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('users.show', compact('user'));
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return redirect()->route('pages.user')->with('success', 'Utilisateur crée avec success');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        //utilisateur existe
        $data = DB::table('users')->where('username', $request->username)->first();

        $user = null;
        if ($data) {
            $user = new User((array)$data);
            $user->exists = true; // Indique que l'utilisateur existe en base
        }

        if ($user && Hash::check($request->password, $user->password)) {
            //Authentification reussie
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Connection réussie !.');
        }

        return back()->withErrors([
            'password' => 'Mot de passe incorrect'
        ])->withInput();
    }

    public function joinRoom(Request $request, $roomId)
    {

        $user = auth::user();
        $room = Room::findOrFail($roomId);

        //Na pas deja join
        if (!$user->rooms()->where('room_id', $roomId)->exists()) {
            $user->rooms()->attach($room->id, ['role' => 'membre']);
        }

        return redirect()->route('rooms.show', $roomId);
    }
}
