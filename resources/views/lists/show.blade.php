@extends('layouts.app-card')

@section('cardheader')
    Show a List
@endsection

@section('cardcontent')

<h2>{{ $list->name }}</h2>

<p><a href="/lists/{{ $list->id }}/items/create">Create a new Task</a></p>

<table class="table">
    <thead>
        <tr>
            <th>Actions</th>
            <th>Tasks</th>
            <th>Updated</th>
            <th>Completed?</th>
        </tr>
    </thead>
    <tbody>

@foreach ($list->items()->orderBy('updated_at', 'desc')->get() as $item)

    <tr>
        <td>
            <a href="/lists/{{ $list->id }}/items/{{ $item->id }}/edit">Edit</a> |
            <a href="/lists/{{ $list->id }}/items/{{ $item->id }}/delete">Delete</a>
        </td>
        <td>{{ $item->task }}</td>
        <td>{{ $item->prettyUpdate() }}</td>
        <td><input type="checkbox" {{ $item->is_completed ? "checked" : "" }} disabled></td>
    </tr>

@endforeach

@if($list->items()->count() == 0)
    <tr>
        <td colspan=4 class="pt-5 text-center">
            This list has no tasks.<br />
            <a href="/lists/{{ $list->id }}/items/create">Create one!</a>
        </td>
    </tr>
@endif

    </tbody>
</table>

@endsection
