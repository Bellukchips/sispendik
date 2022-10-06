<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TokenResetPassword;
use Illuminate\Support\Str;
use App\Mail\NotificationResetPassword;
use App\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;
    public function sendToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        try {
            //code...
            $checkEmail = User::where('email', $request->email)->get();
            if (count($checkEmail) == 0) {
                # code...
                return response()->json(['errors' => 'Email tidak terdaftar'], 401);
            } else {
                $token = Str::random(30);
                $email = $request->email;
                Mail::to($email)->send(new TokenResetPassword($token));
                $passwordReset = new PasswordReset();
                $passwordReset->email = $request->email;
                $passwordReset->token = $token;
                $passwordReset->save();
                return response()->json(['success' => 'Token berhasil di kirim , Periksa email anda']);
            }
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['errors' => 'Gagal Mengirim email']);
        }
        // return response()->json(['success' => 'Token berhasil di kirim , Periksa email anda']);

    }
    public function validateToken(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            //code...
            $checkToken = PasswordReset::where('token', $request->token)->get();
            if (count($checkToken) == 0) {
                return response()->json(['errors' => 'Token tidak valid'], 401);
            } else {
                return response()->json(['success' => 'Token valid']);
            }
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['errors' => 'Gagal validate token']);
        }
        // if (!isset($passwordReset->email)) {
        //     # code...
        //     return response()->json(['error' => 'Invalid Token'], 401);
        // }
        // $user = User::where('email', $passwordReset->email)->frist();
        // return response()->json($user, 200);
    }
    public function resetPassword(Request $request)
    {
        DB::table('password_resets')->where('email', '=',$request->email)->delete();
        $email = $request->email;
        $password = $request->password;
        $token = Str::random(10);
        Mail::to($email)->send(new NotificationResetPassword($email,$password));
        $affected = DB::table('users')
            ->where('email','=',$request->email)
            ->update(['password' => bcrypt($request->password)]);
        return response()->json(['success'=>'Berhasil']);
        // $user = User::find($request->user_id);
    }
    public function destroy(Request $request){
        DB::table('password_resets')->where('email','=',$request->email)->delete();
    }
}
