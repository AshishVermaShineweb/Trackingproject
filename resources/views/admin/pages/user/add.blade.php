@extends('layouts/contentLayoutMaster')
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
