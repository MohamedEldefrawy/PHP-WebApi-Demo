<?php

use JetBrains\PhpStorm\NoReturn;

class HttpRequestHandler
{
    private array $params = array();
    private string $resource;
    private string $resourceId;
    private array $allowedMethods = ["GET", "POST", "DELETE"];
    private array $allowedResources = ["items"];
    private ItemsService $itemsService;


    public function __construct()
    {
        $requestParameters = explode("/", $_SERVER["REQUEST_URI"]);
        var_dump($requestParameters);
        $this->resource = $requestParameters[3] ?? "";
        $this->resourceId = $requestParameters[4] ?? "";
        $this->itemsService = new ItemsService();
    }

    public function validateMethod()
    {
        $method = strtolower($_SERVER["REQUEST_METHOD"]);
        if (!in_array($method, $this->allowedMethods)) {
            $this->sendErrorResponse(405, "invalid method");
        }
    }

    public function validateResource()
    {
        if (!in_array($this->resource, $this->allowedResources)) {
            $this->sendErrorResponse(400, "Undefined Resource");
        }
    }

    private function sendErrorResponse($status, $error)
    {
        $response = [
            "status" => false,
            "message" => $error
        ];

        http_response_code($status);
        header("Content-Type:application/json");

        echo json_encode($response, true);
    }

    private function sendResponse($response)
    {
        http_response_code(200);
        header("Content-Type:application/json");

        echo json_encode($response, true);
    }


    #[NoReturn] public function getItems()
    {
        header("Content-Type:application/json");
        $items = $this->itemsService->getAllItems();
        $this->sendResponse($items);
    }

    #[NoReturn] public function getItem()
    {
        header("Content-Type:application/json");
        $items = $this->itemsService->selectItem($this->resourceId);
        $this->sendResponse($items);
    }
}
