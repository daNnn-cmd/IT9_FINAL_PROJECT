<?php

namespace App\Http\Controllers;

use App\Models\ServicesH;
use Illuminate\Http\Request;

class ServicesHController extends Controller
{
    // app/Http/Controllers/ServicesHController.php
public function index()
{
    $services = \App\Models\ServicesH::all();
    return view('services_h.index', compact('services'));
}

    public function create()
    {
        return view('services_h.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        ServicesH::create($validated);

        return redirect()->route('services_h.index')->with('success', 'Service added successfully');
    }

    public function edit(ServicesH $services_h)
    {
        return view('services_h.edit', compact('services_h'));
    }

    public function update(Request $request, ServicesH $services_h)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $services_h->update($validated);

        return redirect()->route('services_h.index')->with('success', 'Service updated successfully');
    }

    public function destroy(ServicesH $services_h)
    {
        $services_h->delete();
        return redirect()->route('services_h.index')->with('success', 'Service deleted successfully');
    }
}