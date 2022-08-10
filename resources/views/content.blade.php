@extends('layout.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1>{{ $content->title }}</h1>
    
                <p>
                    By. <a href="/blogs?author={{ $content->author->username }}" class="text-decoration-none">{{ $content->author->name }}</a> <a href="/blogs?category={{ $content->category->slug }}" class="text-decoration-none">#{{ $content->category->name }}</a>
                </p>
                @if ($content->image)
                    <div style="max-height:400px; overflow:hidden;">
                        <img src="{{ asset("storage/" . $content->image) }}" class="img-fluid mt-3" alt="{{ $content->category->name }}">
                    </div>
                @else
                    <img src="https://picsum.photos/1200/400" class="card-img-top img-fluid" alt="{{ $content->category->name }}">
                @endif
                
                <article class="my-3 fs-5">
                    {!! $content->body !!}
                </article>
                
                <a href="/blogs" class="d-block mt-3">Back to Blog</a>
            </div>
        </div>
    </div>

@endsection