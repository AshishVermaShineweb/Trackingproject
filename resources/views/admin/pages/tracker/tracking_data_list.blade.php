@extends('layouts/contentLayoutMaster')

@section('title', "Tracker Information List")

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
  <link rel="stylesheet" href="{{asset('data/animate.min.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
    <input class="flatpickr flatpickr-input active form-control" type="text" placeholder="Select Date.." readonly="readonly" id="select-date">
    <div class="card-body border-bottom d-flex justify-content-between align-items-justify">
      <div><h4 class="card-title p-0 m-0 mb-1">Tracker Information List of <span class="text-danger"><b>{{ucfirst(Session::get("username"))}}</b></span></h4>
      <h5 class="p-0 m-0">Project Name : <span class="text-danger"><b>{{ucfirst(Session::get("projectname"))}}</b></span><h5></div>
       <div><h5 class="p-0 m-0" style="float:right">
        Total Tracking Hours :  {{$totalHour}}/{{$data[0]['hourLimit']}} Hrs
       </h5></div>

    </div>
    <div class="card-datatable table-responsive pt-0">
      <table class="table text-center" id="user-list-table">
        <thead class="table-light">
          <tr>
            <th>Sr.No</th>
            <th>Date</th>

            <th>Details</th>

          </tr>
        </thead>
        <tbody>
       @foreach($data as $key=> $list)





            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ date("d-m-Y",strtotime($list['trackingDate'])) }}</td>


                <td>
                    <a href ="javascript:void(0)" class="btn btn-success show-tracking-details-btn" data="{{ $list['tracker_id'] }}">Tracking Details</a>

                </td>
            </tr>
            @endforeach


        </tbody>
      </table>
    </div>

  </div>
  <!-- list and filter end -->
<div class="modal fade" tabindex="-1" role="dialog" id="show-tracker-details-modal">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tracking List</h5>
        <button type="button" class="close btn modal-close-btn" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row item-box"></div>
      </div>

    </div>
  </div>
</div>

<!----keyword show design modal ------------>
<div class="modal fade" tabindex="-1" role="dialog" id="keyword-tracker-details-modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">All Keyword Type</h5>
          <button type="button" class="close btn keyword-modal-close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" >&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table keyword-show-table">

            </table>

        </div>

      </div>
    </div>
  </div>
<!---end keyword show design modal --------->

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
<script src="{{ asset('data/animatedModal.js') }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>




  <script>

//close btn
$(".modal-close-btn").click(function(){
    $("#show-tracker-details-modal").modal("hide");
});

$(".keyword-modal-close-btn").click(function(){
    $("#keyword-tracker-details-modal").modal("hide");
});


//end close btn

  //check data
  $(".show-tracking-details-btn").each(function(){
    $(this).click(function(){
        $("#show-tracker-details-modal").modal("show");
        var id=$(this).attr("data");
        $.ajax({
            type:"GET",
            url:"{{ url('/company/tracker/user/getTrackingListById') }}",
            data:{
                tracker_id:id
            },
            success:function(response){
              var alldata=response.data;
              if(alldata.length>0){
                $(".item-box").html("");
                var html="";
                $(alldata).each(function(index,data){
                    // console.log(data);
                var date=new Date(data.created_at).toLocaleDateString();
                var hour=new Date(data.created_at).getHours();
                var minutes=new Date(data.created_at).getMinutes();
                var second=new Date(data.created_at).getSeconds();

               var time=[hour,minutes,second].join(":");

                var keyCounter=data.tracking_data[0].keyCounters[0];
                // console.log(keyCounter);
                html+=`<div class="col-4 p-0 mb-0 "  >

                    <div class="card">
                    <div class="card-body p-1">
                        <a href=""  class="text-dark show-keyword-box" data=`+JSON.stringify(keyCounter)+`> <img src="`+data.tracking_data[0].image+`" alt="" width="100%" data="`+data.tracking_data.keyCounters+`"></a>

                    </div>
                    <div class="card-footer py-1 d-flex justify-content-between align-items-center">
                        <div>Date & Time : `+date+` : `+time+`</div>
                        <div class="btn-group">
                            <a class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light show" data-bs-toggle="dropdown" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
                            <div class="dropdown-menu dropdown-menu-end " style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(-96px, 32px, 0px);" data-popper-placement="bottom-end" data-popper-reference-hidden="" data-popper-escaped="">
                                <a href="javascript:void(0)" class="dropdown-item" data="`+data.id+`">
                                    <i class="bi bi-trash3-fill"></i>
                                Remove</a>
                                </div></div>
                    </div>
                </div>
            </div>`;


              });

              $(".item-box").html(html);
              }
              else{
                var html=`<div class="col-12 p-0 mb-0">
                <div class="card">
                    <div class="card-body p-1">
                       <center>
                        <h1 class="text-danger">No Any Data Found</h1></center>

                    </div>


                </div>
            </div>`;
                $(".item-box").html(html);
              }

              $(".show-keyword-box").each(function(){
                $(this).click(function(e){
                    $(".keyword-show-table").html("");
                    e.preventDefault();
                    $("#keyword-tracker-details-modal").modal("show");
                    var keyword=JSON.parse($(this).attr("data"));
                    console.log(keyword);
                    var table=`<tr>
                    <th>
                        Alt Key
                    </th>
                    <th>Ctrl Key</th>
                    <th>Shift Key</th>
                    <th>Meta Key</th>
                    <th>Total key hit</th>

                    <th>Key name</th>
                    <th>Raw code</th>

                </tr>`;
                table+=`<tr>`;
                if(keyword.aletKey){
                    table+=`<td>True</td>`
                }else{
                    table+=`<td>False</td>`;
                }
                if(keyword.ctrlKey){
                    table+=`<td>True</td>`;
                }
                else{
                    table+=`<td>False</td>`;
                }
                if(keyword.shiftKey){
                    table+=`<td>True</td>`;
                }
                else{
                    table+=`<td>False</td>`;
                }
                if(keyword.metaKey){
                    table+=`<td>True</td>`;
                }
                else{
                    table+=`<td>False</td>`;
                }
                table+=`<td>`+keyword.hitCount+`</td>`;

                  let char=String.fromCharCode(keyword.keycode);

                 table+=`<td>`+char+`</td>`;
                 let char1=String.fromCharCode(keyword.rawcode);
                 table+=`<td>`+char1+`</td>`;
             table+="</tr>";
                 $(".keyword-show-table").html(table);
                });
              });


            }
        });

    });

    var fp = $("#select-date").flatpickr({



});
  });
</script>


@endsection


