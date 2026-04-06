<?php namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class EmailHelper
{
    static function sendPasswordResetEmail($view, $data, $to, $subject)
    {
        Mail::send($view, $data, function($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });
    }
}
