
@extends('layouts/contentLayoutMaster')

@section('title', 'setting')

<style>
    .icon-box{
        width: fit-content;
        height: fit-content;
        padding: 10px 15px;
        font-size: 35px;

        display: inline-flex;
        justify-content: center;
        align-content: center;
        color: white;
        border-radius: 2px;

    }
    .content-box h6{
        text-align: left;
        font-weight: 800;
        padding: 0;
        margin: 0;
        margin-bottom: 5px;
    }
    .content-box span{
        text-align: justify;
        font-size: 10px;
        font-weight: 600;
    }
    .content-box{
        padding: 5px 10px;
    }
    .content-card{
        box-shadow: 0px 0px 5px #ccc;
        height: 130px;


    }
    .content-card:hover{
        box-shadow: 0px 0px 10px black;
    }
    .col-sm-4{
        transition: 0.5s;


    }
    .col-sm-4:hover{
        transform: scale(1.05);
    }
.bg-indigo{
    background: indigo;
}
.bg-pink{
    background: deeppink;
}
.bg-sky{
    background-color: #10bff2;
}
.bg-green{
    background-color: #a6c843;
}
.bg-ligth-green{
    background: lightgreen;
}
a{
  color: rgba(14, 15, 16, 0.439) !important;
}

</style>


@section('content')
<div class="row p-0">
<div class="col-sm-12 p-0">
    <div class="card p-0">
        <div class="card-header">
        <p class="header-para"><i class="bi bi-sliders header-icon"></i> <span>Setting</span></p>
        </div>
        <div class="card-body px-1">
          <div class="row">
            <div class="col-sm-4">
                <a href="" >
                    <div class="card">
                        <div class="card-body d-flex  shadow-lg px-1 content-card align-items-center justify-content-between">
                         <div class="icon-box bg-success">
                            <i class="bi bi-person-bounding-box"></i>
                         </div>
                         <div class="content-box">
                            <h6>Account & Billings</h6>
                            <span>Manage your account,subscription,billings details,and view or download invoice
                            </span>
                         </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
               <a href="">
                <div class="card">
                    <div class="card-body d-flex  shadow-lg px-1 content-card align-items-center ">
                     <div class="icon-box bg-primary">
                        <i class="bi bi-person-square"></i>
                     </div>
                     <div class="content-box">
                        <h6>Leave Type</h6>
                        <span>Define Custom Leave Type Suitable For Your Organisation
                        </span>
                     </div>
                    </div>
                </div>
               </a>
            </div>
            <div class="col-sm-4">
                <a href="">
                    <div class="card">
                        <div class="card-body d-flex  shadow-lg px-1 content-card align-items-center">
                         <div class="icon-box bg-warning">
                            <i class="bi bi-person-bounding-box"></i>
                         </div>
                         <div class="content-box">
                            <h6>Departments</h6>
                            <span>Define Custom Departments
                                Suitable For Your Organisation
                            </span>
                         </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4">
                <a href="">
                    <div class="card">
                        <div class="card-body d-flex  shadow-lg px-1 content-card align-items-center">
                         <div class="icon-box bg-info">
                            <i class="bi bi-person-bounding-box"></i>
                         </div>
                         <div class="content-box">
                            <h6>Breaks</h6>
                            <span>Define Custom Break Suitable For Your Organisation
                            </span>
                         </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4">
                <a href="">
                    <div class="card">
                        <div class="card-body d-flex  shadow-lg px-1 content-card align-items-center">
                         <div class="icon-box bg-indigo">
                            <i class="bi bi-person-bounding-box"></i>
                         </div>
                         <div class="content-box">
                            <h6>Tasks  Priority</h6>
                            <span>Define Custom Task Priority Suitable For Your Organisation
                            </span>
                         </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4">
                <a href="">
                    <div class="card">
                        <div class="card-body d-flex  shadow-lg px-1 content-card align-items-center">
                         <div class="icon-box bg-pink">
                            <i class="bi bi-person-bounding-box"></i>
                         </div>
                         <div class="content-box">
                            <h6>Domain Filtering</h6>
                            <span>Add domain to block access for users on specific website
                            </span>
                         </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="/company/users/">
                    <div class="card">
                        <div class="card-body d-flex  shadow-lg px-1 content-card align-items-center">
                         <div class="icon-box bg-sky">
                            <i class="bi bi-person-bounding-box"></i>
                         </div>
                         <div class="content-box">
                            <h6>User Management</h6>
                            <span>Create & manage users informations
                            </span>
                         </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4">
                <a href="">
                    <div class="card">
                        <div class="card-body d-flex  shadow-lg px-1 content-card align-items-center">
                         <div class="icon-box bg-green">
                            <i class="bi bi-person-bounding-box"></i>
                         </div>
                         <div class="content-box">
                            <h6>Product Mapping</h6>
                            <span>Show Productivity,unproductivity to application access for user on specific app or url
                            </span>
                         </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4">
                <a href="/company/users/add">
                    <div class="card">
                        <div class="card-body d-flex  shadow-lg px-1 content-card align-items-center">
                         <div class="icon-box bg-danger">
                            <i class="bi bi-person-bounding-box"></i>
                         </div>
                         <div class="content-box">
                            <h6>Team Management</h6>
                            <span>Define Custom  Team Suitable For Your Organisation
                            </span>
                         </div>
                        </div>
                    </div>
                </a>
            </div>

          </div>
        </div>
    </div>

</div>
</div>

@endsection


