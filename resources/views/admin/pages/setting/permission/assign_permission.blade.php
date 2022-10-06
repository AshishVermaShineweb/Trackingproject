@extends('layouts/contentLayoutMaster')

@section('title', 'Assign Permission')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{asset('vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('data/animate.min.css')}}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
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

</style>

@section('content')
<!-- users list start -->
<section class="app-user-list">

  <!-- list and filter start -->
  <div class="card">
    <div class="card-body border-bottom ">
        <div class="d-flex justify-content-between align-items-center mb-1">

      <div></div>
        </div>
      <div class="card-box">
        <form action="" class="permission-form">
        <div class="form-group mb-2">
            <label for=""><b>Role List</b></label>
            <select  name="role" class="form-control" id="select-role">
                <option value="select-role">Select Role</option>
                @foreach($role as $role_list)
                <option value="{{ $role_list->id }}">{{ $role_list->name }}</option>
                @endforeach
            </select>
        </div>
<div class="row">
 @foreach($permission as $permission_list)
     <div class="col-sm-3 mb-3 d-flex">
        <div class="form-check form-check-primary form-switch">

            <input class="form-check-input" id="" type="checkbox"  name="permission[]" value="{{ $permission_list->id }}" >
            <label class="form-check-label" for="">{{ $permission_list->name }}</label>
          </div>
     </div>

                     @endforeach
</div>

    <button class="btn btn-success float-right" style="float:right">Save</button>
        </form>
      </div>

    </div>

  </div>

</section>



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

    <script>
        $(document).ready(function(){
            $(".permission-form").submit(function(e){
                e.preventDefault();

                      if($("#select-role").val()=="select-role"){
                        toastr['error']("Please Select Role", {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });
                      }else{
                        var data=[];
                        var form=$(".permission-form input[type='checkbox']:checked").serializeArray();

                            form.push({name:"_token",value:"{{ csrf_token() }}"});
                            form.push({name:"role",value:$("#select-role").val()});

                           $.ajax({
                            type:"POST",
                              url:"{{ url('/company/permission/assign') }}",
                              data:form,
                              success:function(response){
                                console.log(response);
                              }
                           });
                      }


            });
        });
    </script>
@endsection
