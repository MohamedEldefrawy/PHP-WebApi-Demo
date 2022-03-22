<?php
$request = new HttpRequestHandler();
$request->validateMethod();
$request->validateResource();
$method = strtolower($_SERVER["REQUEST_METHOD"]);
switch ($method) {
    case "get" :
        {
            $request->getItem();
        }
        break;

}
