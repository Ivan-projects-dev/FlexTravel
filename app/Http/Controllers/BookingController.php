<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BookingController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) 
        {
            $bookings = Booking::with('trip')->get();
        }
        else
        {
            $bookings = Booking::with('trip')->where('user_id', auth()->id())->get();
        }
        return view('bookings.index', compact('bookings'));
    }
    public function create()
    {
        $trips = Trip::all();
        return view('bookings.create', compact('trips'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'trip_date' => 'required|date',
            'is_luxury' => 'sometimes|boolean',
            'card_number' => 'required|string|max:16',
            'expire_date' => 'required|date_format:Y-m',
            'cvc' => 'required|string|max:3',
        ]);
        \Log::info('Store request data:', $request->except(['card_number', 'expire_date', 'cvc']));
        $user = Auth::user();
        Booking::create([
            'user_id' => $user->id,
            'trip_id' => $request->trip_id,
            'trip_date' => $request->trip_date,
            'is_luxury' => $request->is_luxury ?? false,
            'card_number' => $request->card_number,
            'expire_date' => $request->expire_date,
            'cvc' => $request->cvc,
        ]);
        \Log::info('Booking created successfully.');
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.show', compact('booking'));
    }
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $trips = Trip::all();
        return view('bookings.edit', compact('booking', 'trips'));
    }
    public function update(Request $request, $id)
    {
        \Log::info('Updating booking', ['id' => $id, 'data' => $request->all()]);
        $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'trip_date' => 'required|date',
            'is_luxury' => 'sometimes|boolean',
        ]);
        $booking = Booking::findOrFail($id);
        $booking->update([
            'trip_id' => $request->trip_id,
            'trip_date' => $request->trip_date,
            'is_luxury' => $request->has('is_luxury') ? true : false,
        ]); 
        \Log::info('Booking updated', ['id' => $booking->id]);
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
    public function book(Trip $trip)
    {
        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->trip_id = $trip->id;
        $booking->save();
        return redirect()->route('bookings.index')->with('success', 'Trip booked successfully!');
    }
}
