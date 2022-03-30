<?php

namespace Models;
use Illuminate\Database\Capsule\Manager;

class DbContext
{
    private Manager $dbContext;

    public function __construct()
    {
        $this->dbContext = new Manager();
        $this->dbContext->addConnection(CONNECTION_STRING);
        $this->dbContext->setAsGlobal();
        $this->dbContext->bootEloquent();
    }

    /**
     * @return Manager
     */
    public function getDbContext(): Manager
    {
        return $this->dbContext;
    }
}