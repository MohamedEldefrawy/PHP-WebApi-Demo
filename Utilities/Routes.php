<?php

namespace Utilities;

use HttpHandlers\ResponseHandlers;
use Services\ItemsService;

class Routes
{
    private static string $uri;

    public static function router()
    {
        $items = new ItemsService();
        $request = $_SERVER['REQUEST_URI'];
        if (str_contains($_SERVER['REQUEST_URI'], "/items/id")) {
            Routes::$uri = "/items/id";
        } else if (str_contains($_SERVER['REQUEST_URI'], "/items")) {
            Routes::$uri = "/items";
        } else {
            $badRequest = [
                "status" => false,
                "message" => "Bad request",
            ];

            ResponseHandlers::sendResponse($badRequest, 404);
        }

        switch (Routes::$uri) {
            case '/items':
                require_once("./Views/glasses.php");
                break;
            case '/items/id':
                require_once('./Views/glass.php');
                break;
        }
    }
}