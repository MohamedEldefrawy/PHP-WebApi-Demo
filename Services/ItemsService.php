<?php

namespace Services;

use Models\DbContext;

class ItemsService
{
    private DbContext $dbContext;

    public function __construct()
    {
        $this->dbContext = new DbContext();
        $this->dbContext->getDbContext()->setAsGlobal();
        $this->dbContext->getDbContext()->bootEloquent();
    }

    public function getAllItems(): array
    {
        $index = (isset($_GET["index"]) && is_numeric($_GET["index"]) && $_GET["index"] > 0) ? (int)$_GET["index"] : 0;
        $all_records = $this->dbContext->getDbContext()::table("items")->skip($index)->take(PAGE_SIZE)->get();
        $next_index = $index + PAGE_SIZE;
        $next_link = "http://localhost:8080/index.php?index=$next_index";
        $previous_index = (($index - PAGE_SIZE) >= 0) ? $index - PAGE_SIZE : 0;
        $previous_link = "http://localhost:8080/index.php?index=$previous_index";

        if ($all_records->count() > 0) {
            return [
                'success' => true,
                "data" => $all_records,
                "next_link" => $next_link,
                "previous_link" => $previous_link,
                'message' => "all items has been retrieved successfully"
            ];
        } else {
            return [
                'success' => false,
                'message' => "all items hasn't been retrieved successfully"
            ];
        }

    }

    public function insertItem(array $itemData): array
    {
        $result = $this->dbContext->getDbContext()::table("items")->insert($itemData);
        if ($result)
            return [
                'success' => true,
                'message' => "Item has been created"
            ];
        else
            return [
                'success' => false,
                'message' => "Item hasn't been created"
            ];
    }

    public function deleteItem(int $id): array
    {
        $result = $this->dbContext->getDbContext()::table('items')->where('id', $id)->delete();
        if ($result > 0)
            return [
                'success' => true,
                'message' => "Selected item has been deleted"
            ];
        else
            return
                [
                    'success' => false,
                    'message' => "Selected item hasn't been deleted"
                ];
    }

    public function selectItem($id): array
    {
        $result = $this->dbContext->getDbContext()::table('items')->where('id', $id)->first();
        if ($result != null) {
            return [
                'success' => true,
                'message' => "Selected item has been retrieved successfully",
                'data' => $result
            ];
        } else {
            return [
                'success' => false,
                'message' => "Selected item hasn't been retrieved"
            ];
        }
    }
}