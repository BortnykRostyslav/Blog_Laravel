@if($errors->any())
    <div class="row justify-items-center">
        <div class="col-end-11">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dissmiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <ul>
                    @foreach($errors->all() as $errorTxt)
                        <li>{{ $errorTxt }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="row justify-items-center">
        <div class="col-end-11">
            <div class="alert alert-succes" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
                {{ session()->get('success') }}
            </div>
        </div>
    </div>
@endif
