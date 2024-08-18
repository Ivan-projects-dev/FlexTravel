<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'destination' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $trip = new Trip();
        $trip->destination = $request->destination;
        $trip->country = $request->country;
        $trip->description = $request->description;
        $trip->price = $request->price;
        if ($request->hasFile('photo')) 
        {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/photos', $filename);
            $trip->photo = 'photos/' . $filename;
        }
        $trip->save();
        return redirect()->route('trips.index');
    }
    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        return view('trips.show', compact('trip'));
    }
    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        return view('trips.edit', compact('trip'));
    }
    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'destination' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $trip->destination = $request->destination;
        $trip->country = $request->country;
        $trip->description = $request->description;
        $trip->price = $request->price;
        if ($request->hasFile('photo'))
        {
            if ($trip->photo && file_exists(public_path('storage/' . $trip->photo))) 
            {
                unlink(public_path('storage/' . $trip->photo));
            }
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/photos', $filename);
            $trip->photo = 'photos/' . $filename;
        }
        $trip->save();
        return redirect()->route('trips.index');
    }
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        if ($trip->photo && Storage::exists('public/' . $trip->photo)) 
        {
            Storage::delete('public/' . $trip->photo);
        }
        $trip->delete();
        return redirect('/trips')->with('success', 'Trip deleted successfully!');
    }
}