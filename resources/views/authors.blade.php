@extends('layout.main')

@section('container')

<h1>Authors</h1>
<br>
@foreach ($authors as $author)

    <ul>
        <li>
            <h3>
                <a href="/authors/{{ $author->username }}">{{ $author->name }}</a>
            </h3>
        </li>
    </ul>
    
@endforeach
    
@endsection