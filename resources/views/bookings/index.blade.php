@extends('bookings.layout')
@section('content')
<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    @if(Auth::user()->is_admin)
        <h2>All Bookings</h2>
    @endif
    @if(!Auth::user()->is_admin)
        <h2>My Bookings</h2>
    @endif
    @if($bookings->isEmpty())
        <p>No bookings available.</p> 
    @else
        <table class="table table-striped w-full">
            <thead>
                <tr>
                    @if(Auth::user()->is_admin)
                        <th>User ID</th>
                    @endif
                    <th>Destination</th>
                    <th>Luxury Seat</th>
                    <th>Trip Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        @if(Auth::user()->is_admin)
                            <td>{{ $booking->user_id }}</td>
                        @endif
                        <td>{{ $booking->trip->destination }}</td>
                        <td>{{ $booking->is_luxury ? 'Yes' : 'No' }}</td>
                        <td>{{ date('Y-m-d', strtotime($booking->trip_date)) }}</td>
                        <td>
                            @if(!Auth::user()->is_admin)
                                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            @endif
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-4">Book a New Trip</a>
    <a href="{{ url('/') }}" class="btn btn-secondary mb-4" title="Back">Back</a>
</div>
@endsection
