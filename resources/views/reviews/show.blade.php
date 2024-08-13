@extends('reviews.layout')
@section('content')  
<div class="card" style="margin:20px;">
    <div class="card-header">Review</div>
        <div class="card-body">
            <h5 class="card-title">Id : {{ $reviews->id }}</h5>
            <p class="card-text">Author_id : {{ $reviews->user_id }}</p>
            <p class="card-text">Mark : {{ $reviews->mark }}</p>
            <p class="card-text">Comment : {{ $reviews->comment }}</p>
            <p class="card-text">Response : {{ $reviews->response }}</p>
        </div></hr>
    </div>    
    <a href="{{ route('reviews.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Back</a>
</div>