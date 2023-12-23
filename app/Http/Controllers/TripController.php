<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::all();
        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        return view('trips.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'departure' => 'required',
            'destination' => 'required',

        ]);

        Trip::create($validatedData);

        return redirect('/trips')->with('success', 'Trip created successfully!'); // Redirect with success message
    }
}
