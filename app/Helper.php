<?php
namespace App;

if (!function_exists('format_currency')) {

    function format_currency($amount)
    {
        $result = is_numeric($amount) ? number_format($amount) : $amount;
        $result .= ",000đ";
        return $result;
    }
}
