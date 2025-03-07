<?php

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'], // Default role
        ]);
        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json([
            'message' => 'تم التسجيل بنجاح',
            "user"=>$user,
        'token' => $token], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('phone', $validated['phone'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
           // Create a token for the user
        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json(['message' => 'تم تسجسل الدخول بنجاح',
        "user"=>$user,
        'token' => $token]);
    }
}
