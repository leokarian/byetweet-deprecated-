<?php 

use Carbon\Carbon;

function formatTwitterDate($date): string
{
    $dt = Carbon::parse($date);
    $dt->timezone = 'America/Argentina/Buenos_Aires';
    //return $dt->format('d/m/y H:i\h\s');
    return $dt->diffForHumans();
}

