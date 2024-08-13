@extends('trips.layout')

@section('content')
<div class="card" style="margin: 20px;">
    <div class="card-header">Create New Trip</div>
    <div class="card-body">
        <form action="{{ route('trips.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="destination">Destination</label>
                <input class="form-control" name="destination" type="text" id="destination" required>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <select class="form-control" name="country" id="country" required>
                    <option value="Latvia">Latvia</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Estonia">Estonia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input class="form-control" name="price" type="number" step="0.01" id="price" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input class="form-control" name="photo" type="file" id="photo">
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
</div>
@endsection
