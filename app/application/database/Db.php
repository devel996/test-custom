<?php

declare(strict_types=1);

namespace app\application\database;

use app\application\Env;
use PDO;
use PDOStatement;

class Db
{
    private static ?self $instance = null;
    private static PDO $pdo;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        self::init();

        return self::$instance;
    }

    private static function init()
    {
        $host = Env::get('MYSQL_HOST');
        $dbname = Env::get('MYSQL_DATABASE');
        $username = Env::get('MYSQL_USER');
        $password = Env::get('MYSQL_USER_PASSWORD');

        $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
        self::$pdo = new PDO($dsn, $username, $password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function executeQuery($query, $parameters = []): bool|PDOStatement
    {
        $stmt = self::$pdo->prepare($query);

        foreach ($parameters as $key => $value) {
            $stmt->bindValue($key, $value, is_int($value) ?
                PDO::PARAM_INT : PDO::PARAM_STR);
        }

        $stmt->execute();

        return $stmt;
    }

    public function fetchAll($query, $parameters = []): bool|array
    {
        $stmt = $this->executeQuery($query, $parameters);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchOne($query, $parameters = [])
    {
        $stmt = $this->executeQuery($query, $parameters);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data): bool|string
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $query = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $parameters = [];
        $index = 1;
        foreach ($data as $value) {
            $parameters[$index] = $value;
            $index++;
        }

        $this->executeQuery($query, $parameters);

        return self::$pdo->lastInsertId();
    }

    public function createTable($tableName, $columns)
    {
        $columnDefinitions = [];

        foreach ($columns as $columnName => $columnType) {
            $columnDefinitions[] = "{$columnName} {$columnType}";
        }

        $columnsString = implode(', ', $columnDefinitions);

        $query = "CREATE TABLE IF NOT EXISTS {$tableName} ({$columnsString})";

        $this->executeQuery($query);
    }

}