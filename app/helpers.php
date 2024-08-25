<?php
if (! function_exists('formatDate')) {
    function formatDate($date, $format = "Y-m-d")
    {
        if ($date) {
            return DateTime::createFromFormat('Y-m-d', $date)->format($format);
        }
    }
}
