@extends('reviews.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Reviews</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/') }}" class="btn btn-secondary btn-sm" title="Back">Back</a>
                        <br/><br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mark</th>
                                        <th>Comment</th>
                                        <th>Response</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($reviews as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->mark }}</td>
                                        <td>{{ $item->comment }}</td>
                                        <td>{{ $item->response }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection