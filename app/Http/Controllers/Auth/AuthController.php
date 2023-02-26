<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'aspirant',
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'error server'], 500);
        }
        $user = auth()->user(); // Obtiene el usuario autenticado actualmente
        return response()->json(compact('token', 'user'));
    }

    public function register_admin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }


    public function create_aspirant_assign_room(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:6|max:255',
            'email' => 'required|email|max:255|unique:users',
            'room_id' => 'required|min:1'
        ]);

        // Verificar si la sala existe
        $room = Room::find($request->room_id);
        if (!$room) {
            return response()->json([
                'error' => 'La sala no existe.'
            ], 404);
        }

        // Verificar si todavía hay espacio
        $room = Room::findOrFail($request->room_id);
        if ($room->users()->count() >= $room->max_users) {
            return response()->json(['message' => 'La sala ya ha alcanzado el número máximo de usuarios'], 400);
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->name);
        $user->role = 'aspirant';
        $user->room_id = $request->room_id;
        $user->save();

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }
}
