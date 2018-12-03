<?php

if (!function_exists('sortable_link')) {
    function sortable_link($sortable_column, $route = null) {

        $order = 'asc';
        if( request()->has('sort') && request()->get('sort') == $sortable_column)
        {
            if(request()->has('order') && request()->get('order') == 'asc')
                $order = 'desc';
        }

        $route = empty($route) ? \Route::currentRouteName() : $route;
        $link = route($route, array_merge(request()->except('_token'), ['sort' => $sortable_column,'order' => $order]) );
        return  "<a href='$link'><span class='glyphicon glyphicon-sort pull-right'></span>";
    }
}

if (!function_exists('search_filters')) {
    function search_filters($model){
        $key_name = search_route();
        $terms = request()->has('search') ? request()->input('search') : session($key_name);
        if(!empty($terms) && !request()->has('clear')){
            foreach(array_filter($terms) as $field => $search){
                $model = $model->where($field, 'like', "%$search%");
            }
            session([$key_name => $terms]);
        }elseif(request()->has('clear')){
            request()->session()->forget($key_name);
            $terms = [];
        }
        return [$terms, $model];
    }
}

if (!function_exists('search_route')) {
    function search_route(){
        return str_replace('index', 'search', \Route::currentRouteName());
    }
}

if (!function_exists('is_pagination')) {
    function is_pagination($model){
        return $model instanceof \Illuminate\Pagination\AbstractPaginator;
    }
}
