<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit();
}

if (!isset($_POST['cart_id'])) {
    echo json_encode(["status" => "error", "message" => "No cart ID provided"]);
    exit();
}

// Database connection (same as your cart page)
$host = 'localhost';
$db   = 'riandlast';
$user = 'root';
$pass = '';
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "DB connection failed"]);
    exit();
}

$user_id = $_SESSION['user_id'];
$cart_id = intval($_POST['cart_id']);

// Remove the product from the cart
$stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
if ($stmt->execute([$cart_id, $user_id])) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to remove product"]);
}
