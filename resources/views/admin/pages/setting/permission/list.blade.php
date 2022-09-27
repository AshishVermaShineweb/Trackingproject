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
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
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
      <h4 class="card-title">User Listing</h4>

    </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="user-list-table table">
        <thead class="table-light">
          <tr>
            <th></th>
            <th>Name</th>
            <th>Role</th>
            <th>Plan</th>
            <th>Billing</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
      </table>
    </div>
    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <form class="add-new-user modal-content pt-0" id="user-create-form" action="#">
          <button type="button" class="btn-close close-modal-btn" data-bs-dismiss="modal" aria-label="Close" data-toggle="modal">×</button>
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
                                     <input type="text" name="firstname" id="" class="form-control" placeholder="First name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                      <input type="text" name="lastname" id="" class="form-control" placeholder="Last name">
                                      </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="phone" name="phone" id="" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Date of Birth</label>
                                        <input type="date" class="form-control invoice-edit-input date-picker flatpickr-input active" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Department</label>
                                        <select name="department" id="" class="form-control">
                                            <option value="">Default</option>
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
                                         <input type="text" name="firstname" id="" class="form-control" placeholder="Username">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Role</label>
                                          <select name="" id="" class="form-control">
                                            <option value="">Select Role</option>
                                            <option value="">Super Admin</option>
                                            <option value="">Admin</option>
                                            <option value="">Hr</option>
                                            <option value=""> Emplyoee</option>
                                            <option value="">Manager</option>

                                          </select>
                                          </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" name="password" id="" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="password" name="confirm-password" id="" class="form-control" placeholder="Confirm Passowrd">
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

                                              <input type="checkbox" name="lastname" id="" class="form-check-input" placeholder="Last name">
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
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script>
  <script>
    $(document).ready(function(){
        $('#modals-slide-in').on('hide.bs.modal', function (e) {
          e.preventDefault();

});

$(".close-modal-btn").click(function(){
    $('#modals-slide-in').modal("hide");
});
    });
    $('#modals-slide-in').modal({
    backdrop: 'static',
    keyboard: false
})
    $("#user-create-form").submit(function(e){
        e.preventDefault();
        alert();

    });
  </script>
@endsection
