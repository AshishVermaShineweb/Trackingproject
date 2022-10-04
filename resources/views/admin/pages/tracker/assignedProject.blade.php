@extends('layouts/contentLayoutMaster')

@section('title', 'Assigned Project List')

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
  <link rel="stylesheet" href="{{ asset('datepicker.css') }}">


@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">

  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection
<style>
    .new-user-modal .modal-dialog{
        width: 60% !important;
        background: #ccc !important;
    }
    tr{
        transition: 0.5s;

    }
    tr:hover{
        background: #f3f6f9;
        cursor: pointer;
    }
</style>

@section('content')
<!-- users list start -->
<section class="app-user-list">

  <!-- list and filter start -->

  <div class="card">
    <div class="card-body border-bottom">
      <h4 class="card-title">Assigned Project List</h4>


    </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="table text-center" id="user-list-table">
        <thead class="table-light">
          <tr>
            <th>Sr.No</th>
            <th>Name</th>

            <th>Description</th>

            <th>Total Tracking Hours(current week)</th>

            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $key=> $list )

                <tr href="{{ url('/company/tracker/user/trackerInfo') }}?project_id={{ $list->id }}& user_id={{ $list->user_id }}" class="link-tr">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->description }}</td>

                    <td>

                        <p href="" class="text-success font-weight-bold"><b>{{ $list->trackingHours }} / {{ $list->hourLimit }} Hrs</b></p>



                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
                            <div class="dropdown-menu dropdown-menu-end" style=""><a href="{{ url('/company/tracker/user/trackerInfo') }}?project_id={{ $list->id }}& user_id={{ $list->user_id }}" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 me-50">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                Tracker Info</a>
                                </div></div>

                    </td>
                </tr>


            @endforeach
        </tbody>
      </table>
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
<script src="{{ asset('datepicker.js') }}"></script>
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


    $(".link-tr").each(function(){
        $(this).click(function(){
            window.location.href=$(this).attr("href");
        });
    });



    });


  </script>

  @endsection
