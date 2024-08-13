@extends('trips.layout')

@section('content')
<div class="container">
    <div class="row" style="padding:20px;">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Trips</div>
                <div class="card-body">
                    @if(auth()->check() && auth()->user()->is_admin)
                        <a href="{{ route('trips.create') }}" class="btn btn-success btn-sm" title="Add New Trip">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    @endif
                    <br/><br/>
                    <div class="row">
                        @foreach($trips as $trip)
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <img class="card-img-top" src="{{ $trip->photo ? asset('storage/' . $trip->photo) : 'https://via.placeholder.com/150' }}" alt="Trip Photo">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $trip->destination }}</h5>
                                        <p class="card-text"><strong>Price:</strong> ${{ number_format($trip->price, 2) }}</p>
                                        <a href="{{ route('trips.show', $trip->id) }}" class="btn btn-info btn-sm" title="View Trip">
                                            <i class="fa fa-eye" aria-hidden="true"></i> Details
                                        </a>
                                        @if(auth()->check() && auth()->user()->is_admin)
                                            <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-primary btn-sm" title="Edit Trip">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                            </a>
                                            <form method="POST" action="{{ route('trips.destroy', $trip->id) }}" accept-charset="UTF-8" style="display:inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Trip" onclick="return confirm('Confirm delete?')">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
