<?php

use Illuminate\Database\Capsule\Manager;

class DatabaseConnector
{
    private $dbc;

    public function __construct()
    {
        $this->dbc = new Manager();
        $this->dbc->addConnection(CONNECTION_STRING);
        $this->dbc->setAsGlobal();
        $this->dbc->bootEloquent();
    }

    /**
     * @return Manager
     */
    public function getDbc()
    {
        return $this->dbc;
    }
}