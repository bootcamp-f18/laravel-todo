@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Lists</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

<p><a href="/lists/create">Create a new List</a></p>

<ul>

@foreach ($lists as $list)
    <li>{{ $list->name }}</li>
@endforeach

</ul>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
