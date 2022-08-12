@extends('layouts.main')

@section('container')
    <h1 class="mb-5">{{ $post->title }}</h1>

    <p>Author: <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a></p>

    {{-- tanda {!!  !!}, supaya laravelnya dapat menjalankan tag html --}}
    {!! $post->body !!}

    <a href="/posts" class="d-block mt-3">Back to Posts</a>
@endsection