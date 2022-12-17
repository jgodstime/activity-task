<?php

use Carbon\Carbon;

if (! function_exists('formatDate')) {
    function formatDate($datValue)
    {
        $date = new Carbon($datValue);

        return $date->isoFormat('MMM Do YYYY');
    }
}

if (! function_exists('formatDateTime')) {
    function formatDateTime($datValue)
    {
        $date = new Carbon($datValue);

        return $date->isoFormat('MMM Do YYYY, h:mm a');
    }
}

if (! function_exists('strLimit')) {
    function strLimit($string, $lenght)
    {
        // strip tags to avoid breaking any html
        $string = strip_tags($string);
        if (strlen($string) > $lenght) {
            // truncate string
            $stringCut = substr($string, 0, $lenght);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }

        return $string;
    }
}
