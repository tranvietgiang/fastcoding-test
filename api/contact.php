<?php
require_once __DIR__ . '/../models/DataStore.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $message === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Please fill in all fields']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Email is invalid']);
    exit;
}

$conn = DataStore::connection();

if (!$conn) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Cannot connect to database']);
    exit;
}

$stmt = $conn->prepare('INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)');

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Cannot prepare contact request']);
    exit;
}

$stmt->bind_param('sss', $name, $email, $message);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Cannot save contact message']);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
