<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $dbConfig = require APP_ROOT . '/config/database.php';
        $this->db = Database::getInstance($dbConfig)->getConnection();
    }
}
