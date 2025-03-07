<?php

// app/Http/Controllers/AdditionalController.php
namespace App\Http\Controllers;

use App\Models\Additional;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
class AdditionalController extends Controller
{
    use HasApiTokens;
    public function index()
    {
        return Additional::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        return Additional::create($validated);
    }

    public function show(Additional $additional)
    {
        return $additional;
    }

    public function update(Request $request, Additional $additional)
    {
        $validated = $request->validate([
            'name' => 'string',
            'price' => 'numeric',
        ]);

        $additional->update($validated);
        return $additional;
    }

    public function destroy(Additional $additional)
    {
        $additional->delete();
        return response()->noContent();
    }
}
