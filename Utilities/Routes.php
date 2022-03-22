<?php

class Routes
{
    public static function router()
    {
        $request = $_SERVER['REQUEST_URI'];
        $uri = str_contains($_SERVER['REQUEST_URI'], "/id") ? "/item/id" : "/item";

        switch ($request) {
            case '/items':
                require_once('./Views/glasses.php');
                break;
            case '/items/id':
                require_once('./Views/glass.php');
                break;
        }
    }
}