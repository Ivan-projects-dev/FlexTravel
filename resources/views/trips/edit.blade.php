@extends('trips.layout')
@section('content')
    <div class="container">
        <div class="row" style="padding:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Edit Trip</div>
                    <div class="card-body">
                        <form action="{{ url('/trips/' . $trip->id) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                                <label for="destination">Destination</label>
                                <input type="text" class="form-control" id="destination" name="destination" value="{{ $trip->destination }}" required>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ $trip->country }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $trip->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $trip->price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                                @if($trip->photo)
                                    <img src="{{ asset('storage/' . $trip->photo) }}" alt="Current Trip Photo" class="mt-2" style="max-width: 100px;">
                                @endif
                            </div><br>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ url('/trip') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection