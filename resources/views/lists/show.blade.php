@extends('layouts.app-card')

@section('cardheader')
    Show a List
@endsection

@section('cardcontent')

<h2>{{ $list->name }}</h2>

List items go here!

@endsection
