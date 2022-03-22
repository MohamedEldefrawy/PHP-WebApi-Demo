<?php

class RequestHandlers
{
    public static function sendResponse($response, $statusCode)
    {
        http_response_code($statusCode);
        header("Content-Type:application/json");
        echo json_encode($response, true);
        exit();
    }
}