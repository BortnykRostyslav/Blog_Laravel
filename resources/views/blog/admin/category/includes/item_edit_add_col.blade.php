@php
    /** @var \App\Models\BlogCategory $item */
@endphp
<div class="row justify-items-center">
    <div class="col-end-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary">Сохранити</button>
            </div>
        </div>
    </div>
</div><br>
@if($item->exists)
    <div class="row justify-items-center">
        <div class="col-end-12">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>ID: {{ $item->id }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-items-center">
        <div class = "col-end-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Створено</label>
                        <input type="text" value="{{ $item->creted_at }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="title">Змінено</label>
                        <input type="text" value="{{ $item->update_at }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="title">Видалено</label>
                        <input type="text" value="{{ $item->deleted_at }}" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
@endif
