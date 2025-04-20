<?php

namespace App\Core\DB;

use App\Core\Config;
use PDO;
use PDOException;

class PDODatabase
{
    private static PDO $connection;

    public static function load(): void {
        $driver = Config::get('db.driver');
        $host = Config::get('db.host');
        $port = Config::get('db.port');
        $dbname = Config::get('db.database');
        $username = Config::get('db.username');
        $password = Config::get('db.password');

        $dsn = "$driver:host=$host;port=$port;dbname=$dbname";

        self::connect($dsn, $username, $password);
    }

    /**
     * Constructor - establishes connection to PDO database
     *
     * @param string $dsn Path to PDO database
     */
    public static function connect(string $dsn, string $username, string $password): void {
        try {
            self::$connection = new PDO($dsn, $username, $password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    /**
     * Executes SQL query
     *
     * @param string $sql SQL query to execute
     * @return bool Success status
     */
    public static function Execute(string $sql): bool
    {
        try {
            $statement = self::$connection->prepare($sql);
            return $statement->execute();
        } catch (PDOException $e) {
            die("Query execution error: " . $e->getMessage());
        }
    }

    /**
     * Executes SQL query and returns result as associative array
     *
     * @param string $sql SQL query to execute
     * @return array Result data
     */
    public static function Fetch(string $sql): array
    {
        try {
            $statement = self::$connection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query fetch error: " . $e->getMessage());
        }
    }

    /**
     * Creates a new record in specified table
     *
     * @param string $table Table name
     * @param array $data Associative array of column => value pairs
     * @return int|bool ID of created record or false on failure
     */
    public static function Create(string $table, array $data): false|int
    {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));

            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $statement = self::$connection->prepare($sql);

            foreach ($data as $key => $value) {
                $statement->bindValue(":$key", $value);
            }

            $statement->execute();
            return self::$connection->lastInsertId();
        } catch (PDOException $e) {
            die("Create record error: " . $e->getMessage());
        }
    }

    /**
     * Reads a record from specified table by ID
     *
     * @param string $table Table name
     * @param int $id Record ID
     * @return array|bool|null Record data or false if not found
     */
    public static function Read(string $table, int $id): bool|array|null
    {
        try {
            $sql = "SELECT * FROM $table WHERE id = :id LIMIT 1";
            $statement = self::$connection->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result !== false ? $result : null;
        } catch (PDOException $e) {
            die("Read record error: " . $e->getMessage());
        }
    }

    /**
     * Updates a record in specified table
     *
     * @param string $table Table name
     * @param int $id Record ID
     * @param array $data Associative array of column => value pairs
     * @return bool Success status
     */
    public static function Update(string $table, int $id, array $data): bool
    {
        try {
            $setParts = [];
            foreach (array_keys($data) as $key) {
                $setParts[] = "$key = :$key";
            }
            $setClause = implode(", ", $setParts);

            $sql = "UPDATE $table SET $setClause WHERE id = :id";
            $statement = self::$connection->prepare($sql);

            $statement->bindValue(":id", $id);
            foreach ($data as $key => $value) {
                $statement->bindValue(":$key", $value);
            }

            return $statement->execute();
        } catch (PDOException $e) {
            die("Update record error: " . $e->getMessage());
        }
    }

    /**
     * Deletes a record from specified table
     *
     * @param string $table Table name
     * @param int $id Record ID
     * @return bool Success status
     */
    public static function Delete(string $table, int $id): bool
    {
        try {
            $sql = "DELETE FROM $table WHERE id = :id";
            $statement = self::$connection->prepare($sql);
            $statement->bindValue(":id", $id);

            return $statement->execute();
        } catch (PDOException $e) {
            die("Delete record error: " . $e->getMessage());
        }
    }

    /**
     * Counts records in specified table
     *
     * @param string $table Table name
     * @return int Number of records
     */
    public static function Count(string $table): int
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM $table";
            $statement = self::$connection->prepare($sql);
            $statement->execute();

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return (int)$result['count'];
        } catch (PDOException $e) {
            die("Count records error: " . $e->getMessage());
        }
    }
}