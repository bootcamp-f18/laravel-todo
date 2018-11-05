@extends('layouts.app-card')

@section('cardheader')
    Delete a Task from <a href="/lists/{{ $item->todolist_id }}">{{ $item->list()->first()->name }}</a>
@endsection

@section('cardcontent')

<form class="" method="post" action="/lists/{{ $item->todolist_id }}/items/{{ $item->id }}">
    @method('DELETE')
    @csrf
    <div class="form-group">
        <label for="task">Task Description</label>
        <input class="form-control" type="text" id="task" name="task" value="{{ $item->task }}" readonly>
    </div>
    <div class="form-group">
        <label for="is_completed">Completed? </label>
        <input type="checkbox" name="is_completed" id="is_completed" {{ $item->is_completed ? "checked" : "" }} disabled>
    </div>
    <button type="submit" class="btn btn-danger">Delete Task</button>
</form>

@endsection
