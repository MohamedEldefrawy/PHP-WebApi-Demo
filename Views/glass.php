<?php
$itemsController = new ItemsControllers();
$itemsController->validateMethod();
$itemsController->validateResource();
$method = strtolower($_SERVER["REQUEST_METHOD"]);
switch ($method) {
    case "get" :
        {
            $itemsController->getItem();
        }
        break;

}


