@extends('layouts/contentLayoutMaster')

@section('title', 'Role List')

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
        <div class="d-flex justify-content-between align-items-center mb-2">
      <div><h4 class="card-title">Roles Listing</h4></div>
      <div><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-role-modal">Add Role</button></div>
        </div>
      <div class="card-box">
        <table class="table tabel-strippped role-list-table text-center">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Role Name</th>
                    <th>Is Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
      </div>

    </div>

  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->
<!---add role modal---------->
<div class="modal fade" tabindex="-1" role="dialog" id="add-role-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Role</h5>
          <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form  id="role-form">
            @csrf
            <div class="form-group mb-1">
                <label for="">Role Name</label>
                <input type="text" name="role" id="" class="form-control" placeholder="Role Name" required>
            </div>
            <div class="form-group mb-1">
                <label for="">Is Active</label>
                <select name="status" id="" class="form-control">
                    <option value="1">
                        Active
                    </option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Role</button>
            </div>
           </form>
        </div>

      </div>
    </div>
  </div>
<!---end add role modal --------->
<!--confirm modal---->

<div class="modal fade" tabindex="-1" role="dialog" id="update-role-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Role</h5>
          <button type="button" class="close btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form  id="update-role-form">
            @csrf
            <div class="form-group mb-1">
                <label for="">Role Name</label>
                <input type="text" name="role" id="" class="form-control" placeholder="Role Name" required>
            </div>
            <div class="form-group mb-1">
                <label for="">Is Active</label>
                <select name="status" id="" class="form-control">
                    <option value="1">
                        Active
                    </option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Role</button>
            </div>
           </form>
        </div>

      </div>
    </div>
  </div>
<!-- Button trigger modal -->


  <!-- Modal -->
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
<!---end confirm modal ------------>
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
        getRoleList("asc");

});

    $("#role-form").submit(function(e){
        e.preventDefault();
        var form =$(this).serialize();
        $.ajax({
            type:"POST",
            url:"{{ '/company/roles/add' }}",
            data:form,
            success:function(response){
                if(response.code==200){
                    toastr['success']('Role created Successfully', {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });
    $("#add-role-modal").modal("hide");
    $("#role-form").trigger("reset");
          getRoleList("desc");

                }else{
                    // console.log(response.message);
                    toastr['error'](response.message, {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });
                }
            },
            error:function(response){
              console.log(response.message);
                toastr['error'](response.message, {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });
            }
        });

    });


    function getRoleList(order_by){
        $.ajax({
            type:"GET",
            url:"{{ url('/company/roles/list') }}",
            data:{
                order:order_by,
            },
            success:function(response){
                if(response.length>0){
                  var html="";
                  $(response).each(function(index,data){
                    html+="<tr>";
                    html+="<td>"+eval(index+1)+"</td>";
                    html+="<td>"+data.name+"</td>";
                    if(data.status==1){
                        html+="<td><span class='badge rounded-pill badge-light-success'>Active</span></td>";
                    }else{
                        html+="<td><span class='badge rounded-pill badge-light-danger'>Deactive</span></td>";
                    }

                    html+="<td><button class='btn btn-outline-success btn-circle edit-role-btn' style='margin-right:5px;' data="+data.id+"><i class='bi bi-pencil-square '></i></button><button class='btn btn-outline-danger btn-circle delete-role-btn' data="+data.id+"><i class='bi bi-trash '></i></button></td>";
                    html+="<tr>";
                  });

                  $(".role-list-table tbody").html(html);
                }


                //delete role
                $(".delete-role-btn").click(function(){
                    var role_id=$(this).attr("data");

                    var tr=$(this).parent().parent();
                $("#confirm-modal").modal("show");
                $("#confirm-btn").click(function(){

                      $.ajax({
                    type:"GET",
                    url:"{{ url('/company/roles/delete') }}",
                    data:{
                       role_id:role_id,
                    },
                    beforeSend:function(){
                     $(".confirm-box").addClass("d-none");
                     $(".loader-box").removeClass("d-none");
                     $(".loader-box").html("<h3 class='text-success'>Please Wait...</h3>");
                    },
                    success:function(response){
                      if(response.code==200){
                        $(".loader-box").html("<h3 class='text-success'>Role Delete Successsfully</h3>");
                        setTimeout(() => {
                            $("#confirm-modal").modal("hide");
                            $(tr).addClass("bg-danger text-white");


                        }, 1000);

                        setTimeout(()=>{
                            $(tr).addClass("animated pulse infinite");
                            $(tr).remove();
                        },2000);


                      }
                    }
                  });

                });

        });

        //update roles
        $(".edit-role-btn").click(function(){
            var role_id=$(this).attr("data");
            var all_td=$(this).parent().parent().find("td");
            var name=$(all_td[1]).html().trim();
            var status=$(all_td[2]).text().trim()==="Active"? "1":"0";
            $("#update-role-modal").modal("show");
            $("#update-role-form input[name='role']").val(name);
            $("#update-role-form input[name='status']").val(status);
            var option=$("#update-role-form select option");

            if($(option[0]).val()==status){
                $(option[0]).attr("selected","selected");
            }
            else{
                $(option[1]).attr("selected","selected");
            }


//submit update-role-form
$("#update-role-form").submit(function(e){
    e.preventDefault();
    var form=$(this).serializeArray();
     form.push({
        name:"id",
        value:role_id,
     });
     $.ajax({
        type:"POST",
        url:"{{ url('/company/roles/update') }}",
        data:form,
        success:function(response){
            $("#update-role-modal").modal("hide");
            if(response.message=="success"){
                toastr['success']('Role updated Successfully', {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });
    getRoleList("desc");


            }else{
                toastr['error'](response.message, {
              closeButton: true,
               tapToDismiss: false,
              progressBar: true,

    });
            }
        }
     });
});

});


            }
        });
    }
  </script>
@endsection
