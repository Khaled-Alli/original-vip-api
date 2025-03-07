<?php

// app/Http/Controllers/LaptopController.php
namespace App\Http\Controllers;

use App\Models\Laptop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
class LaptopController extends Controller
{
    use HasApiTokens;
    public function index()
    {
        return Laptop::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'processor' => 'required|string',
            'processorGeneration' => 'required|string',
            'ram' => 'required|integer',
            'viga' => 'required|string',
            'hard' => 'required|string',
            'isTouch' => 'boolean',
            'camera' => 'boolean',
            'keyboardBacklight' => 'boolean',
            'additionalHard' => 'boolean',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'visibility' => 'boolean',
            'inAED' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('laptop_images', 'public');
        }

        return Laptop::create($validated);
    }

    public function show(Laptop $laptop)
    {
        return $laptop;
    }

    public function update(Request $request, Laptop $laptop)
    {
        $validated = $request->validate([
            'name' => 'string',
            'brand' => 'string',
            'processor' => 'string',
            'processorGeneration' => 'string',
            'ram' => 'integer',
            'viga' => 'string',
            'hard' => 'string',
            'isTouch' => 'boolean',
            'camera' => 'boolean',
            'keyboardBacklight' => 'boolean',
            'additionalHard' => 'boolean',
            'price' => 'numeric',
            'quantity' => 'integer',
            'visibility' => 'boolean',
            'inAED' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($laptop->image) {
                Storage::disk('public')->delete($laptop->image);
            }
            $validated['image'] = $request->file('image')->store('laptop_images', 'public');
        }

        $laptop->update($validated);
        return $laptop;
    }

    public function destroy(Laptop $laptop)
    {
        // Delete the image if it exists
        if ($laptop->image) {
            Storage::disk('public')->delete($laptop->image);
        }
        $laptop->delete();
        return response()->noContent();
    }
}

