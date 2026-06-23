<?php
require_once __DIR__ . '/../config/config.php';

class DataStore
{
    private static ?mysqli $connection = null;

    public static function fetchAll($queries): array
    {
        foreach ((array) $queries as $query) {
            $rows = self::fetchFromDatabase($query);

            if (!empty($rows)) {
                return $rows;
            }
        }

        return [];
    }

    public static function fetchOne($queries): array
    {
        $rows = self::fetchAll($queries);

        return $rows[0] ?? [];
    }

    public static function connection(): ?mysqli
    {
        if (self::$connection instanceof mysqli) {
            return self::$connection;
        }

        try {
            mysqli_report(MYSQLI_REPORT_OFF);
            $conn = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, (int) PORT);

            if ($conn->connect_error) {
                return null;
            }

            $conn->set_charset(DB_CHARSET);
            self::$connection = $conn;

            return self::$connection;
        } catch (Throwable $error) {
            return null;
        }
    }

    private static function fetchFromDatabase(string $query): array
    {
        $conn = self::connection();

        if (!$conn) {
            return [];
        }

        $result = $conn->query($query);

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}
