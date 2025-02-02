<?php

namespace App\Http\Controllers\Auth;

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class RecoveryController extends Controller
{
    public function getEmail()
    {

       return view('Recovery.Recovery');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);
        $code = rand(10000,99999);


        DB::table('password_resets')->insert(
            ['email' => $request->email, 'code' => $code, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('recovery.Email.verify',['code' => $code], function($message) use ($request) {
                  $message->to($request->email);
                  $message->from('canonrinso@gmail.com');
                  $message->subject('Reset Password Notification');
        });

        return redirect('/codeverify')->with($message = true);
    }
}