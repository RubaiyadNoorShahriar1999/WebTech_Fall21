<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");

final class Database
{
    private const DB_NAME = _CONFIG['DB_NAME'];
    private const DB_HOST = _CONFIG['DB_HOST'];
    private const DB_USERNAME = _CONFIG['DB_USERNAME'];
    private const DB_PASSWORD = _CONFIG['DB_PASSWORD'];

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public static function getConnection(): PDO
    {
        try {
            $pdo = new PDO("mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME, self::DB_USERNAME, self::DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return null;
    }
}
