<?php

if (!function_exists('arr_flatten')) {
    function arr_flatten(array $array) {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { if(!empty($a)) $return[] = $a; });
        return $return;
    }
}

if (!function_exists('multi_array_flatten')) {
    function multi_array_flatten($array, $return = array()) {
       foreach ($array as $key => $value) {
           if (is_array($value)){ $return = array_merge($return, multi_array_flatten($value));}
           else {$return[$key] = $value;}
       }
       return $return;
    }
}
