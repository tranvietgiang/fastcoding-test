<?php

declare(strict_types=1);

require_once __DIR__ . '/config.php';

final class DB
{
    private static ?PDO $connection = null;

    public static function connect(): PDO
    {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        self::createDatabaseIfMissing();

        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            DB_HOST,
            DB_PORT,
            DB_NAME,
            DB_CHARSET
        );

        self::$connection = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        self::createTablesIfMissing(self::$connection);
        self::seedDefaultData(self::$connection);

        return self::$connection;
    }

    private static function createDatabaseIfMissing(): void
    {
        $dsn = sprintf('mysql:host=%s;port=%d;charset=%s', DB_HOST, DB_PORT, DB_CHARSET);
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        $dbName = str_replace('`', '``', DB_NAME);
        $charset = preg_replace('/[^a-zA-Z0-9_]/', '', DB_CHARSET);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET {$charset} COLLATE {$charset}_unicode_ci");
    }

    private static function createTablesIfMissing(PDO $pdo): void
    {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS services (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(150) NOT NULL,
                description TEXT NOT NULL,
                sort_order INT UNSIGNED NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS properties (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                type VARCHAR(80) NOT NULL,
                area VARCHAR(80) NOT NULL,
                title VARCHAR(180) NOT NULL,
                address VARCHAR(255) NOT NULL,
                price VARCHAR(80) NOT NULL,
                sort_order INT UNSIGNED NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS blogs (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                published_date VARCHAR(80) NOT NULL,
                category VARCHAR(80) NOT NULL,
                title VARCHAR(180) NOT NULL,
                description TEXT NOT NULL,
                sort_order INT UNSIGNED NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS contacts (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(120) NOT NULL,
                email VARCHAR(180) NOT NULL,
                message TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }

    private static function seedDefaultData(PDO $pdo): void
    {
        $count = (int) $pdo->query('SELECT COUNT(*) FROM services')->fetchColumn();

        if ($count > 0) {
            return;
        }

        $path = dirname(__DIR__) . '/data/data.json';
        $json = is_file($path) ? file_get_contents($path) : false;
        $data = $json ? json_decode($json, true) : null;

        if (!is_array($data)) {
            return;
        }

        $pdo->beginTransaction();

        try {
            $serviceStmt = $pdo->prepare('
                INSERT INTO services (title, description, sort_order)
                VALUES (:title, :description, :sort_order)
            ');
            foreach (($data['services'] ?? []) as $index => $service) {
                $serviceStmt->execute([
                    'title' => $service['title'] ?? '',
                    'description' => $service['description'] ?? '',
                    'sort_order' => $index,
                ]);
            }

            $propertyStmt = $pdo->prepare('
                INSERT INTO properties (type, area, title, address, price, sort_order)
                VALUES (:type, :area, :title, :address, :price, :sort_order)
            ');
            foreach (($data['properties'] ?? []) as $index => $property) {
                $propertyStmt->execute([
                    'type' => $property['type'] ?? '',
                    'area' => $property['area'] ?? '',
                    'title' => $property['title'] ?? '',
                    'address' => $property['address'] ?? '',
                    'price' => $property['price'] ?? '',
                    'sort_order' => $index,
                ]);
            }

            $blogStmt = $pdo->prepare('
                INSERT INTO blogs (published_date, category, title, description, sort_order)
                VALUES (:published_date, :category, :title, :description, :sort_order)
            ');
            foreach (($data['blogs'] ?? []) as $index => $blog) {
                $blogStmt->execute([
                    'published_date' => $blog['date'] ?? '',
                    'category' => $blog['category'] ?? '',
                    'title' => $blog['title'] ?? '',
                    'description' => $blog['description'] ?? '',
                    'sort_order' => $index,
                ]);
            }

            $pdo->commit();
        } catch (Throwable $error) {
            $pdo->rollBack();
            throw $error;
        }
    }
}
