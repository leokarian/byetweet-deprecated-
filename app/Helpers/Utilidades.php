<?php

use Carbon\Carbon;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Log;


class Utilidades
{
    
    public static function twitterDateFormat($date)
    {
        $dt = Carbon::parse($date);
        $dt->timezone = 'America/Argentina/Buenos_Aires';
        return $dt->format('d/m/y H:i\h\s');
    }

    public static function twitterDateFormatHumans($date)
    {
        $dt = Carbon::parse($date);
        $dt->timezone = 'America/Argentina/Buenos_Aires';
        return $dt->diffForHumans();
    }

    public static function btlog($text){
        Log::info($text);
    }
}