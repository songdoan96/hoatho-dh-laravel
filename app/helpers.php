<?php
if (!function_exists('formatDate')) {
    function formatDate($date, $format = "Y-m-d")
    {
        if (isset($date)) {
            $timestamp = strtotime($date);
            return date($format, $timestamp);
        }
    }
}

if (!function_exists('before8h')) {
    function before8h()
    {
        $currentTime = date("H:i:s");
        $time8h = date("08:00:00");
        if ($currentTime < $time8h) {
            return true;
        }
        return false;
    }
}
if (!function_exists('after8h')) {
    function after8h()
    {
        $currentTime = date("H:i:s");
        $time8h = date("08:00:00");
        if ($currentTime >= $time8h) {
            return true;
        }
        return false;
    }
}
if (!function_exists('lunchTime')) {
    function lunchTime()
    {
        $currentTime = date("H:i:s");
        $time11h30 = date("11:30:00");
        $time12h30 = date("12:30:00");
        if ($currentTime > $time11h30 && $currentTime < $time12h30) {
            return true;
        }
        return false;
    }
}
if (!function_exists('after17h')) {
    function after17h()
    {
        $currentTime = date("H:i:s");
        $time17h = date("17:00:00");
        if ($currentTime >= $time17h) {
            return true;
        }
        return false;
    }
}
if (!function_exists('formatNumber')) {
    function formatNumber($number, $decimals = 0)
    {

        /*if (empty($number)) {
        return 0;
    }
    if (fmod($number, 1) == 0) {
        return number_format($number, 0, '.', ' ');
    } else {
        return number_format($number, 2, '.', ' ');
    }*/

        if (empty($number)) {
            return 0;
        }
        if (fmod($number, 1) == 0) {
            return number_format($number, 0, ',', '.');
        } else {
            return number_format($number,  $decimals, ',', '.');
        }


        // if (isset($number)) {
        //     return number_format($number, $decimals, ",", ".");
        // }
    }
}
