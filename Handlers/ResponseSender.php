<?php

namespace HttpHandlers;

use JetBrains\PhpStorm\NoReturn;

class ResponseSender
{
    #[NoReturn] public static function sendResponse($response, $statusCode)
    {
        http_response_code($statusCode);
        echo json_encode($response, true);
        exit();
    }
}