@extends('app')

@section('content')
    @php
        /** @var \App\Models\BlogCategory $item */
    @endphp
    <form method="POST" action="{{ route('categories.update', $item->id) }}">
        @method('PATCH')
        @csrf
        <div class="container">
            <div class="col-end-5">
                @include('blog.admin.category.includes.item_edit_main_col')
            </div>
            <div class="col-end-3">
                @include('blog.admin.category.includes.item_edit_add_col')
            </div>
        </div>
    </form>
@endsection
