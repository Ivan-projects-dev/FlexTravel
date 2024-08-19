@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Debugging My Bookings</h1>
    @if($bookings->isEmpty())
        <p>No bookings available.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Booking Date</th>
                    <th>Trip Destination</th>
                    <th>Trip Country</th>
                    <th>Luxury Option</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ date('Y-m-d', strtotime($booking->date)) }}</td>
                        <td>{{ $booking->trip->destination }}</td>
                        <td>{{ $booking->trip->country }}</td>
                        <td>{{ $booking->is_luxury ? 'Yes' : 'No' }}</td>
                        <td>{{ $booking->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection