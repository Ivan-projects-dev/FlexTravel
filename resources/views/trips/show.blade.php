@extends('trips.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Trip Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        @if($trip->photo)
                            <img src="{{ asset('storage/' . $trip->photo) }}" alt="Trip Photo" class="img-fluid">
                        @endif
                    </div>
                    <h5 class="card-title">{{ $trip->destination }}</h5>
                    <p class="card-text"><strong>Country:</strong> {{ $trip->country }}</p>
                    <p class="card-text"><strong>Description:</strong> {{ $trip->description }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $trip->price }}</p>
                    <a href="{{ url('/trips') }}" class="btn btn-primary">Back to List</a>
                    @auth
                    @unless(auth()->user()->is_admin)
                        <hr>
                        <h5>Book This Trip</h5>
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="trip_id" value="{{ $trip->id }}">
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
                        </form>
                        <a href="{{ url('/bookings') }}">My bookings</a>
                        @endunless
                        @endauth
                        @guest
                        <hr>
                        <p class="text-danger">Please <a href="{{ route('login') }}">login</a> to book this trip.</p>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection