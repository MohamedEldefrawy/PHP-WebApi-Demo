<?php

class Routes
{
    public static function router()
    {
        $request = $_SERVER['REQUEST_URI'];
        if (str_contains($_SERVER['REQUEST_URI'], "/item/id")) {
            $uri = "/item/id";
        } else if (str_contains($_SERVER['REQUEST_URI'], "/item")) {
            $uri = "/item";
        }

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