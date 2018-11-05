@extends('layouts.app-card')

@section('cardheader')
    Create a Task in <a href="/lists/{{ $list->id }}">{{ $list->name }}</a>
@endsection

@section('cardcontent')

<form class="" method="post" action="/lists/{{ $list->id }}/items">
    @csrf
    <div class="form-group">
        <label for="task">Task Description</label>
        <input class="form-control" type="text" id="task" name="task" placeholder="What do you want to do?">
    </div>
    <div class="form-group">
        <label for="is_completed">Completed? </label>
        <input type="checkbox" name="is_completed" id="is_completed">
    </div>
    <button type="submit" class="btn btn-success">Add Task</button>
</form>

@endsection
