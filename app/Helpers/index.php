<?php

use Carbon\Carbon;

function logDirectory($folder) {
    return $folder;
}

function getDateYMd($date){
    $year = Carbon::parse($date)->format('Y');
    $month = Carbon::parse($date)->format('M');
    $day = Carbon::parse($date)->format('d');
    return [
      'year' => $year,
      'month' => $month,
      'day' => $day
    ];
}
