<?php

namespace App\Http\Controllers\Admin;

use App\Models\Director;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as RoutingController;

class DirectorController extends RoutingController
{
    public function index()
    {
        $directors = Director::all();
        return view('admin.directors.index', compact('directors'));
    }

    public function create()
    {
        return view('admin.directors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'bio' => 'nullable|string',
        ]);

        Director::create($request->all());

        return redirect()->route('admin.directors.index')->with('success', 'Director created successfully!');
    }

    public function edit(Director $director)
    {
        return view('admin.directors.edit', compact('director'));
    }

    public function update(Request $request, Director $director)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'bio' => 'nullable|string',
        ]);

        $director->update($request->all());

        return redirect()->route('admin.directors.index')->with('success', 'Director updated successfully!');
    }

    public function destroy(Director $director)
    {
        $director->delete();
        return redirect()->route('admin.directors.index')->with('success', 'Director deleted successfully!');
    }
}
