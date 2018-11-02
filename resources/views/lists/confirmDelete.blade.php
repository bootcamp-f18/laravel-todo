@extends('layouts.app-card')

@section('cardheader')
    Delete a List
@endsection

@section('cardcontent')

<form class="" method="post" action="/lists/{{ $list->id }}">
    @method('DELETE')
    @csrf
    <div class="form-group">
        <label for="listname">List Name</label>
        <input class="form-control" type="text" id="listname" name="listname" value="{{ $list->name }}" readonly>
    </div>
    <input type="hidden" name="list_id" value="{{ $list->id }}">
    <button type="submit" class="btn btn-danger">Delete List</button>
</form>

@endsection
