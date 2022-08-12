{{-- @dd($variable_name) var_dump die nya .php di blade.php --}}

{{-- extends dari file parent yang mana --}}
@extends('layouts.main')

{{-- section yang mana yang mau diaplikasikan --}}
@section('container')
    
    @foreach ($posts as $post)
        <article class="mb-5">
            <h2>
                <a href="/posts/{{ $post['slug'] }}">{{ $post['title'] }}</a>
            </h2>
            <h5>By: {{ $post['author'] }}</h5>
            <p>{{ $post['body'] }}</p>
        </article>
    @endforeach

@endsection