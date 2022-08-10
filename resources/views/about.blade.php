@extends('layout.main')

@section('container')
    <h2>{{ $name }}</h2>
    <h4>{{ $email }}</h4>
    <img src="image/{{ $image }}" alt="{{ $name }}" width="200" class="img-thumbnail">
@endsection