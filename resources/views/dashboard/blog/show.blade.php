@extends('dashboard.layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <h1>{{ $blog->title }}</h1>

                <a href="/dashboard/blog" class="btn btn-info text-decoration-none"><span data-feather="arrow-left"></span> Back</a>
                <a href="/dashboard/blog/{{ $blog->slug }}/edit" class="btn btn-warning text-decoration-none"><span data-feather="edit"></span> Edit</a>
                <form action="/dashboard/blog/{{ $blog->slug }}" method="post" class="d-inline">
                    @method("delete")
                    @csrf
                    <button class="btn btn-danger text-decoration-none" onclick="return confirm('Are you sure want to delete it?')"><span data-feather="x-circle"></span> Delete</button>
                </form>
                
                @if ($blog->image)
                    <div style="max-height:350px; overflow:hidden;">
                        <img src="{{ asset("storage/" . $blog->image) }}" class="img-fluid mt-3" alt="{{ $blog->category->name }}">
                    </div>
                @else
                    <img src="https://picsum.photos/1200/400" class="img-fluid mt-3" alt="{{ $blog->category->name }}">
                @endif
                
                <article class="my-3 fs-5">
                    {!! $blog->body !!}
                </article>
                
                <a href="/dashboard/blog" class="d-block mt-3">Back to All Blog</a>
            </div>
        </div>
    </div>

@endsection