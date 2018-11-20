@extends('layouts.app-card')

@section('cardheader')
    My Lists
@endsection

@section('cardcontent')

<p><a href="/lists/create">Create a new List</a></p>

<table class="table">
    <thead>
        <tr>
            <th>Actions</th>
            <th>List Name</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>

@foreach ($lists as $list)
    <tr>
        <td>
            <a href="/lists/{{ $list->id }}" dusk="items-{{ $list->id }}">Items</a> |
            <a href="/lists/{{ $list->id }}/edit" dusk="edit-{{ $list->id }}">Edit</a> |

        @if ($list->items()->count() > 0)
            <span class="text-black-50">Delete</span>
        @else
            <a href="/lists/{{ $list->id }}/delete" dusk="delete-{{ $list->id }}">Delete</a>
        @endif

        </td>
        <td>{{ $list->name }}</td>
        <td>{{ $list->prettyUpdate() }}</td>
    </tr>
@endforeach

</ul>

@endsection
