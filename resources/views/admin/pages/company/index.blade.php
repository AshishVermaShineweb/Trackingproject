@extends('admin.layout.header')
@section('title','Company')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h5>Company List</h5>
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
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Compnay Name</th>
                                    <th>Email</th>
                                    <th>Timezone</th>
                                    <th>Login Ip</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$list)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $list->name }}</td>
                                <td>{{ $list->email }}</td>
                                <td>{{ $list->timezone }}</td>
                                <td>{{ $list->loginip }}</td>
                                <td>
                                    @if ($list->active)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Deactive</span>

                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-outline-danger btn-icon"><i class="icofont icofont-trash"></i></button>
                                    <button class="btn btn-success btn-outline-success btn-icon"><i class="icofont icofont-edit"></i></button>
                                </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
//     const capture = async () => {
//   const canvas = document.createElement("canvas");
//   const context = canvas.getContext("2d");
//   const video = document.createElement("video");

//   try {
//     const captureStream = await navigator.mediaDevices.getDisplayMedia();
//     video.srcObject = captureStream;
//     // context.drawImage(video, 0, 0, window.width, window.height);
//     const frame = canvas.toDataURL("image/png");
//     alert(frame);
//     // captureStream.getTracks().forEach(track => track.stop());
//     // window.location.href = frame;
//   } catch (err) {
//     console.error("Error: " + err);
//   }
// };

// capture();
</script>
@endsection
