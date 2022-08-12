@extends('layouts.main')

@section('container')
    <h1 class="mb-5">{{ $post->title }}</h1>

    <p>By. Panji Maulana in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a></p>

    {{-- tanda {!!  !!}, supaya laravelnya dapat menjalankan tag html --}}
    {!! $post->body !!}

    <a href="/posts">Back to Posts</a>
@endsection