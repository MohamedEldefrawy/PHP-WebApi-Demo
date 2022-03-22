<?php

class Routes
{
    public static function router()
    {
        $request = $_SERVER['REQUEST_URI'];
        $uri = str_contains($_SERVER['REQUEST_URI'], "/id") ? "/item/id" : "/item";

        switch ($request) {
            case '/items':
            case '/items/id':
                require_once("./Handlers/HttpRequestHandler.php");
                break;
            case '/glasses':
                require_once('./Views/glasses.php');
                break;
        }
    }
}