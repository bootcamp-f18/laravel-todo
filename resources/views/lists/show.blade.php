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
            <th>Completed?</th>
        </tr>
    </thead>
    <tbody>

@foreach ($list->items()->get() as $item)

    <tr>
        <td>
            <a href="/lists/{{ $list->id }}/items/{{ $item->id }}/edit">Edit</a> |
            <a href="/lists/{{ $list->id }}/items/{{ $item->id }}/delete">Delete</a>
        </td>
        <td>{{ $item->task }}</td>
        <td><input type="checkbox"></td>
    </tr>

@endforeach

    </tbody>
</table>

@endsection
