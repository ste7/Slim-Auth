<?php

Class Helper
{
    public static function url(){
        $url = explode('/', $_SERVER['PHP_SELF']);
        $page = $url[count($url) - 1];
        
        return $page;
    }
}