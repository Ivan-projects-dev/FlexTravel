@extends('bookings.layout')
@section('content')
<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1>Edit Booking</h1>
    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="trip_id">Select Trip:</label>
            <select name="trip_id" id="trip_id" class="form-control" required>
                @foreach($trips as $trip)
                    <option value="{{ $trip->id }}" {{ $trip->id == $booking->trip_id ? 'selected' : '' }}>
                        {{ $trip->destination }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="trip_date">Trip Date:</label>
            <input type="date" name="trip_date" id="trip_date" class="form-control" value="{{ $booking->trip_date }}" required>
        </div>
        <div class="form-group">
            <label for="is_luxury">
                <input type="checkbox" name="is_luxury" id="is_luxury" value="1" {{ $booking->is_luxury ? 'checked' : '' }}> Luxury Option
            </label>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update Booking</button>
    </form>
    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to delete this booking?');">Delete Booking</button>
    </form>
</div>
@endsection
