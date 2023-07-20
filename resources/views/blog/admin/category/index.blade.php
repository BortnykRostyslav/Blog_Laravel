@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-items-center">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="btn btn-primary" href="{{ route('categories.create') }}">Добавити</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Категорія</th>
                                <th>Батьківський</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $item)
                                @php /** @var \App\Models\BlogCategory $item */ @endphp
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $item->id) }}">
                                            {{ $item->title }}
                                        </a>
                                    </td>
                                    <td @if(in_array($item->parent_id, [0, 1])) style="color:coral" @endif>
{{--                                        {{ $item->parentCategory->title ?? '?' }}--}}
{{--                                        {{--}}
{{--                                            $item->parentCategory->title--}}
{{--                                                ??($item->id === \App\Models\BlogCategory::ROOT--}}
{{--                                                    ? 'Корінь'--}}
{{--                                                    : '???')--}}
{{--                                        }}--}}

                                        {{ $item->parentTitle }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
            <br>
            <div class="row justify-items-center">
                <div class="col-md-12">
                    <div class="card-body">
                        {{ $paginator->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
