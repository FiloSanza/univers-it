<?php

namespace App\Http\Controllers;

use App\Enums\NotificationTypes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MailSettingsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return $mixed
     */
    public function __invoke()
    {
        $user = Auth::user();
        $mail_settings = $user->mailSettings()->first();
        $res = array();
        foreach (NotificationTypes::cases() as $type) {
            $str = $type->value;
            $res[$str] = $mail_settings->$str;
        }
        return $res;
    }
}
