<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Funksioni për login
     */
    public function login(Request $request)
    {
        // Validimi i të dhënave të kërkesës
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Autentikimi i përdoruesit
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Krijimi i një tokeni për përdoruesin
            $token = $user->createToken('CinemaApp')->plainTextToken;

            // Kthejnë token dhe një mesazh sukses
            return response()->json([
                'message' => 'Successfully logged in',
                'token' => $token,
                'role' => $user->role
            ]);
        }

        // Nëse autentikimi dështon
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Funksioni për regjistrimin e përdoruesit
     */
    public function register(Request $request)
    {
        // Validimi i të dhënave të kërkesës
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Krijimi i përdoruesit të ri
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),  // Përdor bcrypt për fjalëkalimet
            'role' => $request->role // Ose 'user'
        ]);

        // Krijimi i një tokeni për përdoruesin
        $token = $user->createToken('CinemaApp')->plainTextToken;

        // Kthejnë token dhe mesazh sukses
        return response()->json([
            'message' => 'User successfully registered',
            'token' => $token,
            'role' => $user->role // Shto rolin këtu
        ]);
    }

    /**
     * Funksioni për logout
     */
    public function logout(Request $request)
    {
        // Fshirja e të gjitha tokeneve për përdoruesin
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Logged out successfully']);
    }
}
