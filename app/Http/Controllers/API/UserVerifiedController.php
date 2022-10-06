<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SchoolCollection;
use App\Mail\NotifikasiAkunDiNonaktifkan;
use App\User;
use PDO;
use Illuminate\Support\Facades\Mail;

class UserVerifiedController extends Controller
{
    //
    public function index()
    {
        $users = User::where(['status' => '1', 'deleted_status' => '0'])->orderBy('created_at', 'DESC')->admin();
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
            'email' => 'required|email|exists:users,email',
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
                'status' => $request->status
            ]);
            if($request->status == 0){
                Mail::to($request->email)->send(new NotifikasiAkunDiNonaktifkan());
            }
            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['status' => 'error', 'data' => $e->getMessage()], 200);
        }
    }
    public function destroy($id)
    {
        //safe delete
        $user = User::find($id);
        $user->update(['deleted_status' => '1']);
        return response()->json(['status' => 'success']);
    }
}
