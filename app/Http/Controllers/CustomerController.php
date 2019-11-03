<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class CustomerController extends Controller
{
    //
    public function viewPwReset()
    {
        return view('home.customer');
    }

    public function sendPwReset(Request $request)
    {
        Mail::to($request->mail_ad);
    }
}
