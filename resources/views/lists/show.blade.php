@extends('layouts.app-card')

@section('cardheader')
    Show a List
@endsection

@section('cardcontent')

<h2>{{ $list->name }}</h2>

<ul>

@foreach ($list->items()->get() as $item)

    <li>{{ $item->task }}</li>

@endforeach

</ul>

@endsection
