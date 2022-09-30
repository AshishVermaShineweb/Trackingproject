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
    <div class="card-body border-bottom">
      <h4 class="card-title">Assigned Project List</h4>


    </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="table" id="user-list-table">
        <thead class="table-light">
          <tr>
            <th>Sr.No</th>
            <th>Name</th>

            <th>Description</th>
            <th>Hour Limit</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $key=> $list )
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $list->name }}</td>
                <td>{{ $list->description }}</td>
                <td>
                    {{ $list->hourLimit }}

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
    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" id="user-create-form" action="#">
            @csrf
          <button type="button" class="btn-close close-modal-btn"  aria-label="Close" >×</button>
          <div class="modal-header mb-1 bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          </div>
          <div class="moda-body flex-group1 px-2">

                <div class="card mb-0">
                    <div class="card-header">
                        <h5>Basic Information</h5>

                    </div>
                    <div class="card-body">

                        <div class="row mb-1">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                     <input type="text" name="firstname" id="" class="form-control" placeholder="First name" >
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                      <input type="text" name="lastname" id="" class="form-control" placeholder="Last name" >
                                      </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="" class="form-control" placeholder="Email" >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="phone" name="phone" id="" class="form-control" placeholder="Phone" >
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Date of Birth</label>
                                        <input type="date" class="form-control invoice-edit-input date-picker flatpickr-input active" name="dob" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Department</label>
                                        <select name="department" id="" class="form-control" >
                                            <option value="default">Default</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="card mb-0">
                        <div class="card-header">
                            <h5>Login Information</h5>
                        </div>
                        <div class="card-body">

                            <div class="row mb-1">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                         <input type="text" name="username" id="" class="form-control" placeholder="Username" >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Role</label>
                                          <select name="role" id="" class="form-control" >
                                            <option value="">Select Role</option>
                                            <option value="Super Admin">Super Admin</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Hr">Hr</option>
                                            <option value="Employee"> Emplyoee</option>
                                            <option value="Manager">Manager</option>

                                          </select>
                                          </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" name="password" id="" class="form-control" placeholder="Password" >
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="password" name="confirm-password" id="" class="form-control" placeholder="Confirm Passowrd" >
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div class="card mb-0">
                            <div class="card-header">
                                <h5>Tracking</h5>
                            </div>
                            <div class="card-body">

                                <div class="row mb-1">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Capture Screenshot</label>

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">

                                              <input type="checkbox" name="capture-screen" id="" class="form-check-input" placeholder="Last name" >
                                              </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row mb-1">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Desktop App Mode</label>
                                                <div class="pt-3 d-flex justify-content-between pr-3">
                                                <div class="d-flex justify-content-between"><input type="radio" name="desktop-mode" id="" class="form-check-input" value="standard"><span class="ml-3" style="margin-left: :10px !important;">Standard</span></div>
                                                <div><input type="radio" name="desktop-mode" id="" class="form-check-input" value="mini"><span class="ml-3" style="margin-left: :10px !important;">Mini</span></div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group shadow-lg p-2">
                                                In standard mode user will be require to punch in to start the tracking activities and have access to manage tasks & see their productivity.

                                                  </div>
                                            </div>
                                        </div>



                                </div>


                            </div>
                            <hr>
                            <div class="card mb-0">
                                <div class="card-header border-bottom mb-1">
                                    <h4>Notify User</h4>
                                    <hr>

                                </div>
                                <div class="card-body mb-0">
                                    <div>
                                        <input type="checkbox" name="notify" id="" class="form-check-input">
                                        Send the new user an email about their account
                                    </div>
                                    <br>
                                    <button class="btn btn-info" type="submit">Create New User</button>

                                </div>

                            </div>
                            <div class="error-box"></div>



          </div>
        </form>

      </div>
    </div>
    <!-- Modal to add new user Ends-->
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


    });


  </script>
@endsection
