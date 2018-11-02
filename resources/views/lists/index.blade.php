@extends('layouts.app-card')

@section('cardcontent')

<p><a href="/lists/create">Create a new List</a></p>

<ul>

@foreach ($lists as $list)
    <li>{{ $list->name }}</li>
@endforeach

</ul>

@endsection
