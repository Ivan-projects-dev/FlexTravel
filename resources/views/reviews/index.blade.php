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
                        @auth
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm float-right" title="Log Out">Log Out</button>
                        </form>
                        @endauth
                        @unless(auth()->user()->is_admin)
                            <a href="{{ url('/reviews/create') }}" class="btn btn-success btn-sm" title="Add New Review">Add New</a>
                        @endunless
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
                                        @if(auth()->user()->is_admin)
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($reviews as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->mark }}</td>
                                        <td>{{ $item->comment }}</td>
                                        <td>{{ $item->response }}</td>
                                        <td>
                                            @if(auth()->user()->is_admin)
                                                <a href="{{ url('/reviews/' . $item->id) }}" title="View Review">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                                                </a>
                                                <a href="{{ url('/reviews/' . $item->id . '/edit') }}" title="Edit Review">
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                </a>
                                                <form method="POST" action="{{ url('/reviews/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Review" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                                </form>
                                            @endif
                                        </td>
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