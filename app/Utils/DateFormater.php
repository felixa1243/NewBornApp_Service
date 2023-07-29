<?php

namespace App\Utils;

use Carbon\Carbon;

// utility to format date
class DateFormater
{
    static function toLocal($utcDate, $separator = [
        "from" => "/",
        "to" => "-"
    ]): string
    {
        return Carbon::createFromFormat("Y" . $separator["from"] . "m" . $separator["from"] . "d", $utcDate)->format("d" . $separator["to"] . "m" . $separator["to"] . "Y");
    }

    static function toUtc($localDate, $separator = [
        "from" => "-",
        "to" => "/"
    ]): string
    {
        return Carbon::createFromFormat("d" . $separator["from"] . "m" . $separator["from"] . "Y", $localDate)->format("Y" . $separator["to"] . "m" . $separator["to"] . "d");
    }

    static function todayToLocal(): string
    {
        return Carbon::today()->format("d-m-Y");
    }
}

