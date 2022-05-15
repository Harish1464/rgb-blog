@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if(Session::has('success'))
    <div class="mb-3 alert alert-left alert-success alert-dismissible fade show" role="alert">
        {{Session::get("success")}}
        <button type="button" class="btn-close btn-close-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(Session::has('error'))
    <div class="mb-3 alert alert-left alert-danger alert-dismissible fade show" role="alert">
        {{Session::get("error")}}
        <button type="button" class="btn-close btn-close-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(Session::has('warning'))
    <div class="mb-3 alert alert-left alert-warning alert-dismissible fade show" role="alert">
        {{Session::get("warning")}}
        <button type="button" class="btn-close btn-close-white" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif