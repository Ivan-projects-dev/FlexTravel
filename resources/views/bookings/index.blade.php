@extends('bookings.layout')
@section('content')
<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1>My Bookings</h1>
    @if($bookings->isEmpty())
        <p>No bookings available.</p> 
    @else
        <table class="table table-striped w-full">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Trip ID</th>
                    <th>Luxury seat</th>
                    <th>Trip Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user_id }}</td>
                        <td>{{ $booking->trip_id }}</td>
                        <td>{{ $booking->is_luxury ? 'Yes' : 'No' }}</td>
                        <td>{{ date('Y-m-d', strtotime($booking->trip_date)) }}</td>
                        <td>
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm">Edit</a>
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
</div>
@endsection
