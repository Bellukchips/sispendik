<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\User;

class RolePermissionController extends Controller
{
    //
    public function getAllRole(){
        $roles = Role::all();
        return response()->json(['status'=>'success','data'=>$roles]);
    }

    //get all permission
    public function getAllPermission(){
        $permission = Permission::all();
        return response()->json(['status'=>'success','data'=>$permission]);
    }
    // ambil permission sesuai yang dimiliki role
    public function getRolePermission(Request $request)
    {
        //MELAKUKAN QUERY UNTUK MENGAMBIL PERMISSION NAME BERDASARKAN ROLE_ID
        $hasPermission = DB::table('role_has_permissions')
        ->select('permissions.name')
        ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->where('role_id', $request->role_id)->get();
        return response()->json(['status' => 'success', 'data' => $hasPermission]);
    }
    //atur permission yang di pilih
    public function setRolePermission(Request $request){
        //validasi
        $this->validate($request,[
            'role_id'=>'required|exists:roles,id'
        ]);
        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permissions);
        return response()->json(['status'=>'success']);
    }

    //atur role setiap user
    public function setRoleUser(Request $request){
        $this->validate($request,[
            'user_id'=>'required|exists:users,id',
            'role'=>'required'
        ]);

        $user = User::find($request->user_id);
        $user->syncRoles([$request->role]);
        return response()->json(['status'=>'success']);
    }
}
