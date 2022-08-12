{{-- @dd($variable_name) var_dump die nya .php di blade.php --}}

{{-- extends dari file parent yang mana --}}
@extends('layouts.main')

{{-- section yang mana yang mau diaplikasikan --}}
@section('container')
    <h1 class="mb-5">Post Categories</h1>
    
    @foreach ($categories as $category)
    <ul>
        <li>
            <h2>
                <a href="/categories/{{ $category->slug }}">{{ $category->name }}</a>
            </h2>
        </li>
    </ul>
    @endforeach

@endsection