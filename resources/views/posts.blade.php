{{-- @dd($variable_name) var_dump die nya .php di blade.php --}}

{{-- extends dari file parent yang mana --}}
@extends('layouts.main')

{{-- section yang mana yang mau diaplikasikan --}}
@section('container')
    <h1 class="mb-5">{{ $title }}</h1>
    
    @foreach ($posts as $post)
        <article class="mb-5 border-bottom pb-4">
            <h2><a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a></h2>

            <p>Author: <a href="/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }}</a></p>

            <p>{{ $post->excerpt }}</p>

            <a href="/posts/{{ $post->slug }}" class="text-decoration-none">Read more..</a>
        </article>
    @endforeach

@endsection