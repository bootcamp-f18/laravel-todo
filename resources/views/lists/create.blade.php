@extends('layouts.app-card')

@section('cardcontent')

<form class="" method="post" action="/lists">
    @csrf
    <div class="form-group">
        <label for="listname">List Name</label>
        <input class="form-control" type="text" id="listname" name="listname" placeholder="What do you want to call your list?">
    </div>
    <button type="submit" class="btn btn-primary">Add List</button>
</form>

@endsection
