<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/DB.php';

try {
    $pdo = DB::connect();

    $services = $pdo->query('
        SELECT title, description
        FROM services
        ORDER BY sort_order, id
    ')->fetchAll();

    $properties = $pdo->query('
        SELECT type, area, title, address, price
        FROM properties
        ORDER BY sort_order, id
    ')->fetchAll();

    $blogs = $pdo->query('
        SELECT published_date AS date, category, title, description
        FROM blogs
        ORDER BY sort_order, id
    ')->fetchAll();

    echo json_encode([
        'services' => $services,
        'properties' => $properties,
        'blogs' => $blogs,
    ], JSON_UNESCAPED_UNICODE);
} catch (Throwable $error) {
    http_response_code(500);
    echo json_encode([
        'message' => 'Cannot load data from database.',
        'error' => $error->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
}

