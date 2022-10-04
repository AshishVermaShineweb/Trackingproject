@extends('layouts/contentLayoutMaster')

@section('title', "Tracker Information")

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{asset('vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">




@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">

  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset('lightgallery.css') }}" type="text/css">
@endsection
<style>
    .new-user-modal .modal-dialog{
        width: 60% !important;
        background: #ccc !important;
    }
</style>

@section('content')
<!-- users list start -->
<section class="app-user-list">


  <!-- list and filter start -->
    <a class="btn btn-primary mb-1" href="{{ url()->previous() }}"><i class="bi bi-arrow-left" style="font-size: 20px;"></i></a>
  <div class="card">

    <div class="card-body border-bottom d-flex justify-content-between alignitems-center">
      <div><h4 class="card-title p-0 m-0 mb-1">Tracker Information of <span class="text-danger"><b>{{ucfirst(session()->get("username"))}}</b></span></h4>
        <h5 class="p-0 mb-1">Project Name : <span class="text-danger"><b>{{ucfirst(session()->get("projectname"))}}</b></span><h5>

        <h5 class="">Date : <span class="text-danger"><b>{{ \Carbon\Carbon::parse($data[0]['trackingDate'])->format("d-m-Y") }}</b></span></h5></div>
      <div>
        <h4>Total Tacking Hours : <span class="text-success">{{ $data[0]['trackingHours'] }}/{{ $data[0]['hourLimit'] }} Hrs</span></h4>
      </div>
    </div>
    <div class="card-datatable table-responsive pt-0">
      <div class="row">
       @if(count($data)>0 && !empty($data))
       <div class="card">
        <div class="card-body">


       <ul id="lightgallery" class="list-unstyled row">
        @foreach ($data as $key=>$list)
        <li class="col-xs-6 col-sm-4 col-md-4 col-sm-4 mb-2"   data-responsive="{{ $list->tracking_data[0]['image'] }} 375, {{ $list->tracking_data[0]['image'] }} 480, {{ $list->tracking_data[0]['image'] }} 800" data-src="{{ $list->tracking_data[0]['image'] }}" data-sub-html="
            <table class='table text-center text-white'>
                <tr>
                    <th>Shift key</th>
                    <th>Meta Key</th>
                    <th>Ctrl Key</th>
                    <th>Alt key</th>
                    <th>Rawcode</th>
                    <th>Keyword</th>
                    <th>Time</th>



                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7:30</td>
                </tr>
            </table>


            ">

                        <a href="" class="w-100">

                            <img class="img-responsive" src="{{ $list->tracking_data[0]['image'] }}" width="100%">
                            </a>





            </li>
            @endforeach

       </ul>



        </div>
       </div>
       @else
        <center> <h1 class="text-danger">No Any Data </h1></center>
       @endif
      </div>
    </div>

  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/cleave.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/cleave/addons/cleave-phone.us.js')) }}"></script>

  <script src="{{asset('vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>
  <script src=""></script>
  <script>
    $(document).ready(function(){
        function hideModel(){
            $("#modals-slide-in").modal({
            backdrop: 'static',
            keyboard: false
        });
            $('#modals-slide-in').on('hide.bs.modal', function (e) {
                e.preventDefault();
            });
        }

        hideModel();

        $(".close-modal-btn").click(()=>{
            $('#modals-slide-in').modal("hide");
            $('#modals-slide-in').on('hide.bs.modal', function (e) {




        });
        });

        function getUserList(){
           $.ajax({
            type:"GET",
            url:"{{ url('/company/users/list-data') }}",
            success:function(response){
                console.log(response);
            }
           });

        }
        getUserList();

$(".add-new-user").submit(function(e){
        e.preventDefault();

        var form=$(this).serialize();


        $.ajax({
            type:"POST",
            url:"{{ url('/company/users/create') }}",
            data:form,
            success:function(response){
               if(response.message=="success"){
                toastr['success']('User Resgiter Successfully', {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });

    $(".add-new-user").trigger("reset");
               }
            },
            error:function(err){
                if (err.status == 422 || err.status==500) {
                    toastr['error']('All filed is required', {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });
                    // display errors on each form field
            $.each(err.responseJSON.error, function (i, errors) {


                var el = $(document).find('[name="'+i+'"]');
                if($(el).next().is("span")==false){
                    el.after($('<span style="color: red;">'+errors[0]+'</span>'));
                }
                else{
                    $(el).next().remove();
                }
            });
        }
            }
        });







    });





       //select date
       $("#select-date").change(function(){
        var username=$(this).attr("user");
        var project=$(this).attr("project");

        window.location.href="/company/tracker/user/getTrackerInfoBySpecificDate?+&_u="+username+"&p_="+project+"&d_="+btoa($(this).val());
       });






    });


  </script>

<script src="{{ url('jquery.js') }}"></script>
<script src="{{ url('lightgallery-all.min.js') }}"></script>
<script>
    //load poppu box of tracking image
    $('#lightgallery').lightGallery();
    var url=window.location;
    localStorage.setItem("url",url);
    var $lg = $('#lightgallery');

$lg.lightGallery();

// Fired immediately once lightgallery is closed.
$lg.on('onCloseAfter.lg', function (event) {
    var url=localStorage.getItem("url");
    window.history.replaceState("", "Tracking details",url );
});

$lg.on('onBeforeClose.lg', function (event) {
    var url=localStorage.getItem("url");
    window.history.replaceState("", "Tracking details",url );
});





</script>
@endsection
