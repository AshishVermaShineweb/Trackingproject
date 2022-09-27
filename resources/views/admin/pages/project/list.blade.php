@extends('admin.layout.header')
@section('content')
<style>
    .modal-confirm {
	color: #636363;
	width: 400px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
	text-align: center;
	font-size: 14px;
}
.modal-confirm .modal-header {
	border-bottom: none;
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -10px;
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -2px;
}
.modal-confirm .modal-body {
	color: #999;
}
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
	padding: 10px 15px 25px;
}
.modal-confirm .modal-footer a {
	color: #999;
}
.modal-confirm .icon-box {
	width: 80px;
	height: 80px;
	margin: 0 auto;
	border-radius: 50%;
	z-index: 9;
	text-align: center;
	border: 3px solid #f15e5e;
}
.modal-confirm .icon-box i {
	color: #f15e5e;
	font-size: 46px;
	display: inline-block;
	margin-top: 13px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #60c7c1;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	min-width: 120px;
	border: none;
	min-height: 40px;
	border-radius: 3px;
	margin: 0 5px;
}
.modal-confirm .btn-secondary {
	background: #c1c1c1;
}
.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
	background: #a8a8a8;
}
.modal-confirm .btn-danger {
	background: #f15e5e;
}
.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
	background: #ee3535;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>

<div class="container ">
    <div class="row">
        <div class="col-sm-12 mb-2">
            <button class="btn btn-info float-right" onclick="window.location.href='{{ url('/company/project/add') }}'"><i class="fa fa-plus"></i></button>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>Project List</h5>
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
                <div class="card-block table-border-style animated zoomIn">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead class="text-center">
                                <tr class="text-center">
                                    <th class="text-center">Sr.No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Hour Limit</th>
                                    <th class="text-center">Active</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$list)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $list['name'] }}</td>
                                <td>{!! Str::limit($list['description'], 50, ' ...') !!}</td>
                                <td>{{ $list['hourLimit'] }} Hrs</td>

                                <td>
                                    @if ($list['active'])
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Deactive</span>

                                    @endif
                                </td>
                                <td class="text-center">
                                    @php $prodID= Crypt::encrypt($list['id']); @endphp
                                    <button class="btn btn-danger btn-outline-danger btn-icon delete-btn" data="{{ $prodID }}" ><i class="icofont icofont-trash"></i></button>
                                    <a class="btn btn-success btn-outline-success btn-icon text-success" href="{{ url('/company/project/edit') }}/{{$prodID  }}"><i class="icofont icofont-edit"></i></a>
                                </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal animated zoomIn">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="material-icons">&#xE5CD;</i>
				</div>
				<h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete these records? This process cannot be undone.</p>
			</div>
			<div class="modal-footer justify-content-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger delete-confirm-btn">Delete</button>
			</div>
		</div>
	</div>
</div>
@endsection


@section("script")
<script>
$(function(){
    $(".delete-btn").each(function(){
        $(this).click(function(){
            var id=$(this).attr("data");
            $("#myModal").modal("show");
            $(".delete-confirm-btn").click(()=>{
                window.location.href="{{ url('/company/project/delete/') }}/"+id;
            });
        });
    });

})
</script>



<script>
    @if(session()->has("wrong_status"))
    triggerAlert('{{ session()->get("message") }}',"error");
@endif
@if(session()->has("success_status"))
triggerAlert('{{ session()->get("message") }}',"success");
@endif

</script>


@endsection
