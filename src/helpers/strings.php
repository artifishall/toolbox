<?php

if (!function_exists('dollar_format')) {
    function dollar_format(float $number , int $decimals = 2 , string $dec_point = '.' , string $thousands_sep = '') {
        return number_format($number, 2, $dec_point, $thousands_sep);
    }
}

if (!function_exists('period_case')) {
    function period_case($str) {
        return preg_replace(['/\]/','/[\[\s\/]+/'],['','.'],$str);
    }
}
