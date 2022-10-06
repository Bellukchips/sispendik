<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolCollection;
use App\Http\Resources\UserCollection;
use App\Mail\NotifikasiAkunDiAktifkan;
use App\School;
use Spatie\Permission\Models\Permission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where(['status' => '0', 'deleted_status' => '0'])->orderBy('created_at', 'DESC')->admin();
        if (request()->q != '') {
            $users = $users->where('name', 'LIKE', '%' . request()->q . '%');
        }
        $users = $users->paginate(10);
        return new SchoolCollection($users);
    }
    public function edit($id)
    {
        $user = User::find($id); //MENGAMBIL DATA BERDASARKAN ID
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }
    public function update(Request $request, $id)
    {

        //validate form

        $this->validate($request, [
            'id_users' => 'required',
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'nullable|min:6|string',
        ]);
        try {
            //code...
            $user = User::find($id);
            $password = $request->password != '' ? bcrypt($request->password) : $user->password;
            $user->update([
                'name' => $request->name,
                'password' => $password,
                'email' => $request->email,
                'status' => $request->status,
                'email_verified_at' => now()
            ]);
            if ($request->status == 1) {
                Mail::to($request->email)->send(new NotifikasiAkunDiAktifkan($request->id_users,$request->name,$request->email));
            }
            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['status' => 'error', 'data' => $e->getMessage()], 200);
        }
    }
    //delete data
    public function destroy($id)
    {
        //safe delete
        $user = User::find($id);
        $school = School::where('id',$id);
        $user->update(['deleted_status' => '1']);
        $school->update(['deleted_status' => '1']);
        return response()->json(['status' => 'success']);
    }
    public function userLists()
    {
        $user = User::where('role', '!=', 2)->get();
        return new UserCollection($user);
    }

    public function getUserLogin()
    {
        $user = request()->user(); //MENGAMBIL USER YANG SEDANG LOGIN
        $permissions = [];
        foreach (Permission::all() as $permission) {
            //JIKA USER YANG SEDANG LOGIN PUNYA PERMISSION TERKAIT
            if (request()->user()->can($permission->name)) {
                $permissions[] = $permission->name; //MAKA PERMISSION TERSEBUT DITAMBAHKAN
            }
        }
        $user['permission'] = $permissions; //PERMISSION YANG DIMILIKI DIMASUKKAN KE DALAM DATA USER.
        return response()->json(['status' => 'success', 'data' => $user]);
    }
}
