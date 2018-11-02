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

<form class="" method="post" action="/lists">
    @csrf
    <div class="form-group">
        <label for="listname">List Name</label>
        <input class="form-control" type="text" id="listname" name="listname" placeholder="What do you want to call your list?">
    </div>
    <button type="submit" class="btn btn-primary">Add List</button>
</form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
