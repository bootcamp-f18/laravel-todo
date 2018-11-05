@extends('layouts.app-card')

@section('cardheader')
    Update a Task from <a href="/lists/{{ $list->id }}">{{ $list->name }}</a>
@endsection

@section('cardcontent')

<form class="" method="post" action="/lists/{{ $list->id }}/items/{{ $item->id }}">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="task">Task Description</label>
        <input class="form-control" type="text" id="task" name="task" value="{{ $item->task }}">
    </div>
    <div class="form-group">
        <label for="is_completed">Completed? </label>
        <input type="checkbox" name="is_completed" id="is_completed" {{ $item->is_completed ? "checked" : "" }}>
    </div>
    <button type="submit" class="btn btn-success">Update Task</button>
</form>

@endsection
