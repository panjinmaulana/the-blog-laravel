@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Posts</h1>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive col-lg-8">
        <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post</a> {{-- href="/dashboard/posts/create" create disini otomatis nanti bakalan di tangkap sama method create(), karena kita menggunakan resource controller --}}
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td> {{-- ketika pake foreach dari laravel, otomatis kita bakal mempunyai variable $loop, iteration u/ memanfaatkan iterasinya --}}
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye" class="align-text-bottom"></span></a> {{-- ini bakalan menuju ke method show() --}}
                            <a href="" class="badge bg-warning"><span data-feather="edit" class="align-text-bottom"></span></a>
                            <a href="" class="badge bg-danger"><span data-feather="x-circle" class="align-text-bottom"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
@endsection