@extends('bookings.layout')
@section('content')
<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1>Book a Trip</h1>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="trip_id">Select a Trip:</label>
            <select name="trip_id" id="trip_id" class="form-control" required>
                <option value="" disabled selected>Select a trip</option>
                @foreach($trips as $trip)
                    <option value="{{ $trip->id }}">{{ $trip->name }} {{ $trip->destination }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="trip_date">Select a Date:</label>
            <input type="date" name="trip_date" id="trip_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="is_luxury">
                <input type="checkbox" name="is_luxury" id="is_luxury" value="1"> Luxury seats
            </label>
        </div>
        <div class="form-group">
            <label for="card_number">Card Number:</label>
            <input type="text" name="card_number" id="card_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="expire_date">Expiration Date:</label>
            <input type="month" name="expire_date" id="expire_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cvc">CVC:</label>
            <input type="text" name="cvc" id="cvc" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Book Now</button>
        <a href="{{ url('/bookings') }}" class="btn btn-secondary mt-3" title="Cancel">Cancel</a>
    </form>
</div>
@endsection