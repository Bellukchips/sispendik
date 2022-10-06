<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchoolCollection;
use App\School;
use App\User;
use Illuminate\Http\Request;

class SchoolController extends Controller
{

    public function index()
    {
        $school = School::where([
            ['id', '!=', '1'],
            ['deleted_status', '0']
        ])->orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $school = $school->where('name', 'LIKE', '%' . request()->q . '%');
        }
        return new SchoolCollection($school->paginate(20));
    }
    public function edit($id)
    {
        $sch = School::find($id);
        return response()->json(['status' => 'success', 'data' => $sch]);
    }
    public function update(Request $request, $id)
    {

        //validate form

        $this->validate($request, [
            'code' => 'required|exists:schools,code',
            'name' => 'required|string|max:100',
            'address' => 'required',

        ]);
        try {
            //code...
            $sch = School::find($id);
            // $user = User::where('id_users', $request->code)->update([
            //     'code' => $request->code,
            //     'name' => $request->name,
            // ]);
            $sch->update([
                'code' => $request->code,
                'name' => $request->name,
                'address' => $request->address,
            ]);
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
        $school = School::find($id);
        $user = User::where('id',$id);
        $school->update(['deleted_status' => '1']);
        $user->update(['deleted_status' => '1']);
        return response()->json(['status' => 'success']);
    }
}
