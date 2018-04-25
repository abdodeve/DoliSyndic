<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

class UserMailController extends Controller
{
    public function send(Request $request)
    {
        // return response()->json('works');
        $objDemo = new \stdClass();
        $objDemo->demo_one = 'Demo One Value';
        $objDemo->demo_two = 'Demo Two Value';
        $objDemo->sender = 'SenderUserName';
        $objDemo->receiver = 'ReceiverUserName';

        Mail::to("abdelhadi.deve@gmail.com")->send(new Email($objDemo));
    }
}
