@extends('reviews.layout')
@section('content')  
<div class="card" style="margin:20px;">
    <div class="card-header">Create New Review</div>
        <div class="card-body">
            <form action="{{ url('reviews') }}" method="post">
                {!! csrf_field() !!}
                <label for="mark">Mark</label><br>
                <input list="marks" id="mark" name="mark" class="form-control">
                <datalist id="marks">
                    <option value="1">
                    <option value="2">
                    <option value="3">
                    <option value="4">
                    <option value="5">
                </datalist></br>
                <label for="comment">Comment</label><br>
                <input type="text" name="comment" id="comment" class="form-control"></br>
                <input type="submit" value="Publish" class="btn btn-success"></br>
            </form>
        </div>
    </div>
</div>
@stop