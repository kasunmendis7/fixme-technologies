<?php

namespace app\core;

class Database
{
    private \PDO $pdo;

    public function __construct(array $config)
    {
        // Extract the database configuration values from the array
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        try {
            // Initialize the PDO connection
            $this->pdo = new \PDO($dsn, $user, $password);
            // Set PDO error mode to exception for better error handling
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // Handle connection errors gracefully
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }
}
