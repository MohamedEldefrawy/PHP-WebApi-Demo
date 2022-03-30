<?php

namespace HttpHandlers\GlassesResponseHandler;

use Controller\ItemsControllers;

class GlassesHandler
{
    public function __construct()
    {

        $itemsController = new ItemsControllers();
        $itemsController->validateMethod();
        $itemsController->validateResource();
        $method = strtolower($_SERVER["REQUEST_METHOD"]);
        switch ($method) {
            case "get" :
            {
                echo $method;
                $itemsController->getItems();
                break;
            }
        }
    }
}