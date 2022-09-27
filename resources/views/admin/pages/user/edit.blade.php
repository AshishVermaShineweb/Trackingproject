@extends('admin.layout.header')
@section("css")


<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

@endsection



@section('content')

<div class="container ">
    <div class="row">
        <div class="col-sm-12 mb-2">
            <button class="btn btn-info float-right" onclick="window.location.href='{{ url('/company/users') }}'"><i class="fa fa-list"></i></button>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>Update User</h5>
                    </div>

                    <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa-chevron-left"></i></li>
                        <li><i class="fa fa-window-maximize full-card" title="Full screen" data-toggle="tooltip"></i></li>
                        <li><i class="fa fa-minus minimize-card" title="Minimize screen" data-toggle="tooltip"></i></li>
                        <li><i class="fa fa-refresh reload-card" title="Reload Page" data-toggle="tooltip"></i></li>
                        <li><i class="fa fa-times close-card" title="Close" data-toggle="tooltip"></i></li>
                    </ul>
                </div>
                </div>
                <div class="card-block table-border-style">
                    <form action="{{ url('/company/users/update') }}" method="POST">
                        @csrf
                        <div class="row mb-1">
                            <div class="col">
                                <label>Name</label>
                                <input type="text" placeholder="Name" class="form-control" name="name" value="{{ $data['name'] }}">
                                @if($errors->has("name"))
                                <p class="text-danger"><i class="fa fa-warning"></i> {{ $errors->first("name") }}</p>
                                @endif
                            <input type="hidden" name="id" value="{{ $data['id'] }}">
                            </div>
                            <div class="col">
                                <label>Email</label>
                                <input type="text" placeholder="Email" class="form-control" name="email" value="{{ $data['email'] }}">
                                @if($errors->has("email"))
                                <p class="text-danger"><i class="fa fa-warning"></i> {{ $errors->first("email") }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Username</label>
                                <input type="text" name="username" id="" class="form-control" placeholder="Username" value="{{ $data['username'] }}">
                                @if($errors->has("username"))
                                <p class="text-danger"><i class="fa fa-warning"></i> {{ $errors->first("username") }}</p>
                                @endif
                            </div>
                            <div class="col">
                                <label for="">Active</label>
                                <select name="active" id="" class="form-control" >
                                    <option value="select active">Select Active</option>
                                <option value="1" {{ $data['active']===1? "selected":"" }}>Yes</option>
                                <option value="0" {{ $data['active']===0? "selected":"" }}> No</option>
                                </select>
                                @if($errors->has("active"))
                                <p class="text-danger"><i class="fa fa-warning"></i> {{ $errors->first("active") }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">

                            <div class="col">
                                <label for="">Timezone</label>
                                <input type="text" name="timezone" id="" placeholder="Timezone" class="form-control" value="{{ $data['timezone'] }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-danger">Update User</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



<script src="{{ url('ckeditor.min.js') }}"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );


</script>



@endsection
@section("script")


<script>
    @if(session()->has("wrong_status"))
    triggerAlert('{{ session()->get("message") }}',"error");
@endif
@if(session()->has("success_status"))
triggerAlert('{{ session()->get("message") }}',"success");
@endif

</script>
@endsection
