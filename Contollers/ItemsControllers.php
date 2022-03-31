<?php

namespace Controller;

use HttpHandlers\ResponseSender;
use JetBrains\PhpStorm\NoReturn;
use Services\ItemsService;

class ItemsControllers
{
//    private array $params = array();
    private string $resource;
    private string $resourceId;
    private array $allowedMethods = ["get", "post", "delete"];
    private array $allowedResources = ["items"];
    private ItemsService $itemsService;


    public function __construct()
    {
        $requestParameters = explode("/", $_SERVER["REQUEST_URI"]);
        $this->resource = $requestParameters[1] ?? "";
        $this->resourceId = $requestParameters[3] ?? "";
        $this->itemsService = new ItemsService();
    }

    public function validateMethod()
    {
        $method = strtolower($_SERVER["REQUEST_METHOD"]);
        if (!in_array($method, $this->allowedMethods)) {
            $response = [
                "status" => false,
                "message" => "BadRequest"
            ];
            ResponseSender::sendResponse($response, 405);
        }
    }

    public function validateResource()
    {
        if (!in_array($this->resource, $this->allowedResources)) {
            $response = [
                "status" => false,
                "message" => "BadRequest"
            ];
            ResponseSender::sendResponse($response, 400);
        }
    }


    #[NoReturn] public function getItems()
    {
        $http_origin = $_SERVER['HTTP_ORIGIN'];

        $allowed_domains = array(
            'http://localhost:63343',
        );


        if (in_array($http_origin, $allowed_domains)) {
            header("Access-Control-Allow-Origin: $http_origin");
        }
        header("Content-Type:application/json");

        $items = $this->itemsService->getAllMeals();
        ResponseSender::sendResponse($items, 200);
    }

    #[NoReturn] public function getItem()
    {
        $http_origin = $_SERVER['HTTP_ORIGIN'];

        $allowed_domains = array(
            'http://localhost:63343',
        );


        if (in_array($http_origin, $allowed_domains)) {
            header("Access-Control-Allow-Origin: $http_origin");
        }
        header("Content-Type:application/json");

        $items = $this->itemsService->selectMeal($this->resourceId);
        ResponseSender::sendResponse($items, 200);
    }

    #[NoReturn] public function deleteItem()
    {
        $http_origin = $_SERVER['HTTP_ORIGIN'];

        $allowed_domains = array(
            'http://localhost:63343',
        );

        if (in_array($http_origin, $allowed_domains)) {
            header("Access-Control-Allow-Origin: $http_origin");
        }

        header("Content-Type:application/json");
        $items = $this->itemsService->deleteMeal($this->resourceId);
        ResponseSender::sendResponse($items, 200);
    }
}
