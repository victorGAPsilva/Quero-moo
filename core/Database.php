<?php

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct(array $dbConfig)
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $dbConfig['host'],
            $dbConfig['dbname'],
            $dbConfig['charset']
        );

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['pass'], $options);
    }

    public static function getInstance(array $dbConfig)
    {
        if (self::$instance === null) {
            self::$instance = new self($dbConfig);
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
