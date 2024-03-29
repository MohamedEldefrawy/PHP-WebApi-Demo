<?php

namespace Utilities;

use HttpHandlers\GlassesResponseHandler\GlassesHandler;
use HttpHandlers\GlassesResponseHandler\GlassHandler;
use HttpHandlers\ResponseSender;
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

            ResponseSender::sendResponse($badRequest, 404);
        }

        switch (Routes::$uri) {
            case '/items':
                new GlassesHandler();
                break;
            case '/items/id':
                new GlassHandler();
                break;
        }
    }
}