@extends('layouts/contentLayoutMaster')

@section('title', 'User List')

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
  <link rel="stylesheet" href="{{ asset('data/animate.min.css') }}">
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
    <div class="card-body border-bottom d-flex justify-content-between align-items-center">
      <div><h4 class="card-title m-0 p-0">User Listing</h4></div>
      <div><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user-modal">Add user</button></div>


    </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="table" id="user-list-table">
        <thead class="table-light">
          <tr>
            <th>Sr.No</th>
            <th>Name</th>


            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
       </tbody>
      </table>

    </div>

  </div>
  <!-- list and filter end -->
</section>
<!--add user modal-------->
<div class="modal fade" tabindex="-1" role="dialog" id="add-user-modal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add User</h5>
          <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" class="add-user">
            @csrf
            <div class="row mb-2">
                <div class="col">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Timezone</label>
                        <input type="text" name="timezone" id="" class="form-control" placeholder="Timezone">
                    </div>
                </div>
            </div>
            <div class="row mb-2">

                <div class="col">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="select-status">
                                Select Status
                            </option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">Add User</button>
          </form>
          <form action="" class="update-user-form d-none">
            @csrf
            <div class="row mb-2">
                <div class="col">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="Name">
                    </div>
                    <input type="hidden" name="id" id="">
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="select-status">
                                Select Status
                            </option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>


            <button class="btn btn-primary">Update User</button>
          </form>

        </div>

      </div>
    </div>
  </div>
<!--end add user modal --------->

<!--user delete confirm modal ----------->
<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-body py-3">
         <center>
            <div class="confirm-box">
                <h2 class="mb-3">Are you sure</h2>
            <button class="btn btn-success confirm-btn mr-2" id="confirm-btn">Confirm</button>
            <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            <div class="loader-box d-none">
                <h3>Please Wait....</h3>
            </div>
        </center>
        </div>

      </div>
    </div>
  </div>
<!---end user delete confirm modal --------->

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
        getUserList("asc");
$(".add-user").submit(function(e){
        e.preventDefault();
        var form=$(this).serialize();
          $.ajax({
            type:"POST",
            url:"{{ url('/company/user/create') }}",
            data:form,
            success:function(response){
                console.log(response);
               if(response.message=="success"){
                toastr['success']('User Resgiter Successfully', {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });
           $(".add-user").trigger("reset");
           getUserList("desc");
           $("#add-user-modal").modal("hide");
               }

               else{
                toastr['error'](response.message, {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });

               }

            },
            error:function(err,xhr,message){
                if (err.status == 422) {
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


    });
     function getUserList(order){
        var html="";
        $.ajax({
            type:"GET",
             url:"{{ url('/company/user/getList') }}",
             data:{
                order:order,
             },
             success:function(response){
                var user_list=response.data.data;
                $(user_list).each(function(index,data){
            var status=data.status==1? '<a class="badge rounded-pill badge-light-success btn status" text-capitalized="" data='+data.id+' status="0">Active</a>':'<a class="badge rounded-pill badge-light-danger btn status" text-capitalized="" data='+data.id+' status="1">Deactive</a>'
            html+=`<tr>
                <td>`+eval(index+1)+`</td>
                <td>`+data.name+`</td>
                <td>`+data.email+`</td>
                <td>
                    `+status+`
                </td>
                <td>
                <a href="" class="btn btn-success edit-btn" data=`+JSON.stringify(data)+`><i class="bi bi-pencil-square"></i></a>
                <a href="" class="btn btn-danger delete-btn" data=`+data.id+`><i class="bi bi-trash"></i></a>
                </td>
            </tr>`;

           });

           $("#user-list-table tbody").html(html);


           //status change
        $(".status").each(function(){
            $(this).click(function(){
                var status=$(this).attr("status");
                var id=$(this).attr("data");
                var btn=this;
                $.ajax({
                    type:"GET",
                    url:"{{ url('/company/user/status') }}",
                    data:{
                        status:status,
                        id:id
                    },
                    success:function(response){
                        console.log(response);
                        if(response.message=="success"){
                            if(status==1){
                            $(btn).removeClass("badge-light-danger");
                            $(btn).addClass("badge-light-success");
                            $(btn).html("Active");
                            $(btn).attr("status",0);
                            }else{
                                $(btn).removeClass("badge-light-success");
                            $(btn).addClass("badge-light-danger");
                            $(btn).html("Deactive");
                            $(btn).attr("status",1);

                            }

                            toastr['success']('Status changed successfully', {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });

                        }else{

                            toastr['error']('Something is wrong ', {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });

                        }
                    }
                });
            });
        });
        //end change status


        //delete user
        $(".delete-btn").each(function(){
            $(this).click(function(e){
                e.preventDefault();
                var id=$(this).attr("data");
                var tr=$(this).parent().parent();
                      $("#confirm-modal").modal("show");

                      $(".confirm-btn").click(function(){
                        $.ajax({
                    type:"GET",
                    url:"{{ url('company/user/delete') }}",
                    data:{
                        id:id,
                    },
                    success:function(response){
                        $("#confirm-modal").modal("hide");
                        if(response.message=="success"){
                            toastr['success']('User Remove Successfully ', {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,
            });
        setTimeout(function(){
        $(tr).addClass("bg-primary text-white");
        $(tr).addClass("animated slideOutRight");
        },1000);
        setTimeout(function(){
         getUserList("desc");
        },1500);
     }else{
        toastr['error'](response.message, {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,
            });
     }



},
error:function(err){
    toastr['error'](err, {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,
            });
}

                });
                      });
            });
        });

        //end delete user
        $(".edit-btn").each(function(){
            $(this).click(function(e){
                e.preventDefault();
                $("#add-user-modal").modal("show");
                $("#add-user-modal .modal-title").html("Update User Details");
                var data=JSON.parse($(this).attr("data"));
                $(".add-user").addClass("d-none");
                $(".update-user-form").removeClass("d-none");
                $(".update-user-form input[name='name']").val(data.name);
                $(".update-user-form input[name='email']").val(data.email);
                $('.update-user-form select option[value='+data.status+']').prop('selected', 'selected');
                $(".update-user-form").submit(function(e){
                    e.preventDefault();


                });

            });
        });

        //start edit user



             }//end main success
        });


     }

  </script>
@endsection
