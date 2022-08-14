@extends('dashboard.layouts.main')

@section('container')

    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h1 class="mb-3">{{ $post->title }}</h1>

                <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left" style="margin-top: -2px"></span> Back to all my posts</a>
                <a href="" class="btn btn-warning"><span data-feather="edit" style="margin-top: -3px"></span> Edit</a>
                <a href="" class="btn btn-danger"><span data-feather="x-circle" style="margin-top: -2px"></span> Delete</a>

                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">

                <article class="my-3 fs-5">
                    {{-- tanda {!!  !!}, supaya laravelnya dapat menjalankan tag html --}}
                    {!! $post->body !!}
                </article>
            </div>
        </div>
    </div>
    
@endsection