<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Gate;

class RoleController extends Controller
{
    function __contruct(){
        $this->middleware('role_or_permission:Role access|Role create|Role edit|Role delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Role create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Role edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Role delete', ['only' => ['destroy']]);
    }


    public function list(){

        return view("admin.pages.setting.roles.list");
    }

    public function get_list(){
        $data=Role::select("name")->get();
        $data['action']="<a href='' class='btn btn-danger'><i class='bi bi-pencil-square'></i></a><a href=''><i class='bi bi-trash'></i></a>";
        return response()->json($data);
    }
}
