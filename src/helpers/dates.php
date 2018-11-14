<?php


if (!function_exists('fix_dates')) {
    /**
     * format unformated dates
     * @method fix_dates
     * @param  string     $str
     * @param  string    $format
     * @return date
     * @author Zach Chisholm
     */
    function fix_dates($str, $format = 'Y-m-d') {
        //match date to remove unwanted text
        preg_match('/\d+[\/-]+\d+[\/-]*\d*|\d{8}|[a-zA-Z]{3}\.\s\d{4}|[a-zA-Z]+\s\d{2},\s\d{4}/', $str, $dates);

        if(empty($dates[0]) || is_empty_date($dates[0])){
            return null;
        }

        $regex = [
            "/^(\d{2})(\d{2})\/(\d{4})$/" => '$3/$1/$2', // MMDD/YYYY
            "/^(\d{2})[\/-](\d{2})[\/-](\d{4})$/" => '$3/$1/$2', // MM/DD/YYYY | MM-DD-YYYY
            "/^(\d{4})\/(\d{2})$/" => '$1/$2/01', // YYYY/MM
            "/^(\d{1})\/(\d{4})$/" => '$2/0$1/01', // M/YYYY
            "/^(\d{2})\/(\d{4})$/" => '$2/$1/01', // MM/YYYY
            "/^(\d{2})\/+(\d{2})\/(\d{2})$/" => '$3/$1/$2', // MM/DD/YY
            "/^(\d{1})\/+(\d{1})\/(\d{4})$/" => '$3/0$1/0$2', // M/D/YYYY
            "/^(\d{1})\/+(\d{2})\/(\d)(\d{2})$/" => '${3}0$4/0$1/$2', // M/DD/YYY
            "/^(\d{2})\/+(\d{2})\/(\d)(\d{2})$/" => '${3}0$4/$1/$2', // MM/DD/YYY
            "/^(\d{2})\/+(\d{2})\/(\d{2})\d(\d{2})$/" => '$3$4/$1/$2', // M/DD/YYYYY
            "/^((20|19)\d{2})(\d{2})(\d{2})$/" => '$1/$3/$4', // YYYYMMDD
            "/^(\d{2})(\d{2})((20|19)\d{2})$/" => '$1/$2/$3', // MMDDYYYY
        ];

        $date = date($format, strtotime(preg_replace(array_keys($regex), $regex, $dates[0], 1)));

        return is_empty_date($date) ? null : $date;
    }
}

if (!function_exists('is_empty_date')) {
    function is_empty_date($date){
        return in_array($date, ['0000-00-00','1970-01-01']);
    }
}
