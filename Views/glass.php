<?php

use Controller\ItemsControllers;

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
    case "delete" :
        {
            $itemsController->deleteItem();
        }
        break;

}


