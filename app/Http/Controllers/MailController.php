<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;
use App\Notifications\TestSendEmail;
use App\Models\User;

class MailController extends Controller
{
    function testemail()
    {
        $user = User::find(2);
        Notification::send($user, new TestSendEmail());
    }
}
