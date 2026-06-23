<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/DB.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed.']);
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $message === '') {
    http_response_code(422);
    echo json_encode(['message' => 'Please fill in all fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['message' => 'Email is not valid.']);
    exit;
}

try {
    $pdo = DB::connect();
    $stmt = $pdo->prepare('
        INSERT INTO contacts (name, email, message)
        VALUES (:name, :email, :message)
    ');
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'message' => $message,
    ]);

    echo json_encode(['message' => 'Message sent successfully.']);
} catch (Throwable $error) {
    http_response_code(500);
    echo json_encode([
        'message' => 'Cannot save contact message.',
        'error' => $error->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
}

