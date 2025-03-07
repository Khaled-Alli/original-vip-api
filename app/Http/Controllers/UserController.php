<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    use HasApiTokens;

    public function index()
    {
        // Get all users
        return User::all();
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,dealer', // Ensure role is either admin or dealer
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'password' => bcrypt($validated['password']), // Hash the password
            'role' => $validated['role'],
        ]);

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        // Show a specific user
        return $user;
    }

    public function update(Request $request, User $user)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'string',
            'phone' => 'string|unique:users,phone,' . $user->id,
            'password' => 'string|min:6',
            'role' => 'in:admin,dealer',
        ]);

        // Update user details
        if ($request->has('password')) {
            $validated['password'] = bcrypt($validated['password']); // Hash the password if provided
        }

        $user->update($validated);
        return $user;
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();
        return response()->noContent();
    }
}
