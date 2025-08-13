<?php
session_start();
include 'db_connection.php'; // contains $pdo

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if cart data exists
if (!isset($_POST['cart_data']) || empty($_POST['cart_data'])) {
    die("Your cart is empty.");
}

$cart_items = json_decode($_POST['cart_data'], true);
$user_id = $_SESSION['user_id'];

// Optional: Get user details (assuming you have users table)
$stmt_user = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt_user->execute([$user_id]);
$user = $stmt_user->fetch();

// Calculate total
$total_amount = 0;
foreach ($cart_items as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

// Insert order into orders table
$stmt_order = $pdo->prepare("INSERT INTO orders 
    (user_id, full_name, email, phone, total_amount, status, created_at) 
    VALUES (?, ?, ?, ?, ?, 'pending', NOW())");

$stmt_order->execute([
    $user_id,
    $user['email'],
    $user['username'],
    '',
    $total_amount
]);

// Get the auto-increment order ID
$order_db_id = $pdo->lastInsertId();
$order_reference = "ORDER_" . $order_db_id; // optional human-readable order reference

// Insert each cart item into order_items table
$stmt_item = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
foreach ($cart_items as $item) {
    $stmt_item->execute([$order_db_id, $item['id'], $item['quantity'], $item['price']]);
}

// Optionally clear cart session
unset($_SESSION['cart_items']);

// Redirect to confirmation page
header("Location: order_confirmation.php?order_ref=$order_reference");
exit;
?>
