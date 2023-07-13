@extends('app')

@section('content')
    @php
        /** @var \App\Models\BlogCategory $item */
    @endphp

    @if($item->exists)
        <form method="POST" action="{{ route('categories.update', $item->id) }}">
        @method('PATCH')
            @else
                <form method="POST" action="{{ route('categories.store', $item->id) }}">
                    @endif
                @csrf
        <div class="container">
            @php
            /** @var \Illuminate\Support\ViewErrorBag $errors */
            @endphp
            @if($errors->any())
                <div class="row justify-items-center">
                    <div class="col-end-11">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $errors->first() }}
                        </div>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="row justify-items-center">
                    <div class="col-end-11">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                {{ session()->get('success') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row justify-items-center">
                <div class="col-end-5">
                    @include('blog.admin.category.includes.item_edit_main_col')
                </div>
                <div class="col-end-3">
                    @include('blog.admin.category.includes.item_edit_add_col')
                </div>
            </div>
        </div>
    </form>
@endsection
