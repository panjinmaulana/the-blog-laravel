@extends('layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->title }}</h1>

                <p>Author: <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>

                {{-- cek apakah ada data image di db --}}
                @if ($post->image)
                    <div style="max-height: 400px; overflow: hidden">
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="{{ $post->category->name }}">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid" alt="{{ $post->category->name }}">
                @endif

                <article class="my-3 fs-5">
                    {{-- tanda {!!  !!}, supaya laravelnya dapat menjalankan tag html --}}
                    {!! $post->body !!}
                </article>

                <a href="/posts" class="d-block mt-3">Back to posts</a>
            </div>
        </div>
    </div>
    
@endsection