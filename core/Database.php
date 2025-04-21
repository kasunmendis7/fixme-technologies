<?php

namespace app\core;

class Database
{
    public \PDO $pdo;

    /* Initializes a PDO connection to the database using configuration settings */
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        try {
            $this->pdo = new \PDO($dsn, $user, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /* Applies new migration files (PHP scripts) that haven’t been executed yet */
    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying Migrations $migration");
            $instance->up();
            $this->log("Applied Migrations $migration");
            $newMigrations[] = $migration;
            //            echo '<pre>';
            //            var_dump($className);
            //            echo '</pre>';
            //            exit;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All Migrations are applied");
        }
    }

    /* Creates the migrations table in the database */
    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    /* Retrieves the list of applied migrations from the database */
    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    /* Saves the list of applied migrations to the database */
    public function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
                                       $str
                                       ");
        $statement->execute();
    }

    /* This is a helper method to prepare SQL statements using the application's PDO connection */
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    /* Logs migration actions or messages to the console with a timestamp */
    protected function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . ']-' . $message . PHP_EOL;
    }
}
