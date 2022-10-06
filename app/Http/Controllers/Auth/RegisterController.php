<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\School;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\ActivationCode;
use App\Mail\LinkActivationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function completedData($activation_code){
        $user = User::find($activation_code); //MENGAMBIL DATA BERDASARKAN ID
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|integer',
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6|string',
            'address' => 'required|string'
        ]);
        try {
            //code...
            $checkcode = User::where('id_users', $request->code)->get();
            if (count($checkcode) > 0) {
                return response()->json(['status' => 'redudancy']);
            } else {
                $activation_code = Str::random(60);
                //save data users
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'id_users' => $request->code,
                    'password' => bcrypt($request->password),
                    'role' => 1,
                    'activation_code' => $activation_code,
                    'deleted_status' => 0
                ]);
                //send email
                Mail::to($request->email)->send(new LinkActivationCode($request->email,$request->name,$activation_code));
                //save data Schools
                School::create([
                    'code' => $request->code,
                    'name' => $request->name,
                    'address' => $request->address
                ]);
                $user->assignRole('admin');
                DB::commit();
                return response()->json(['status' => 'success']);
            }
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['status' => 'failed']);
        }
    } 
}
