<?php

class ItemsControllers
{
    private array $params = array();
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
            ResponseHandlers::sendResponse($response, 405);
        }
    }

    public function validateResource()
    {
        if (!in_array($this->resource, $this->allowedResources)) {
            $response = [
                "status" => false,
                "message" => "BadRequest"
            ];
            ResponseHandlers::sendResponse($response, 400);
        }
    }


    public function getItems()
    {
        header("Content-Type:application/json");
        $items = $this->itemsService->getAllItems();
        ResponseHandlers::sendResponse($items, 200);
    }

    public function getItem()
    {
        header("Content-Type:application/json");
        $items = $this->itemsService->selectItem($this->resourceId);
        ResponseHandlers::sendResponse($items, 200);
    }
}
