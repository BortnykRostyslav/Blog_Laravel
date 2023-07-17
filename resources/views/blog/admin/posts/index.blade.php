@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-items-center">
            <div class="col-end-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="border-t-neutral-200" href="{{ route('blog.admin.posts.create') }}">Написати</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Автор</th>
                                <th>Категорія</th>
                                <th>Заголовок</th>
                                <th>Дата публікації</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $post)
                                @php
                                    /** \App\Models\BlogPosts $post */
                                @endphp
                                <tr @if(!$post->is_published) style="background-color: #6b7280;"@endif>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->category->title}}</td>
                                    <td>
                                        <a href="{{ route('blog.admin.posts.edit', $post->id) }}">{{ $post->title }}</a>
                                    </td>
                                    <td>{{ $post->published_at }}</td>
{{--                                    <td {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M.H:i') : '' }}></td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-items-center">
                <div class="col-end-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
