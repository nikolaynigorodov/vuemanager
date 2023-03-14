<?php

namespace App\Helpers;

class StatusHelper
{
    static protected $status = [
        1 => "Waiting",
        2 => "In progress",
        3 => "Completed"
    ];
    public static function getStatus($status)
    {
        return self::$status[$status];
    }
}
