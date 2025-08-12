<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../sections/authentication/login.php");
    exit();
}
$host = 'localhost';
$db   = 'riandlast';
$user = 'root';
$pass = '';
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$pdo = new PDO($dsn, $user, $pass);

$cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
$action = $_POST['action'] ?? '';

if ($cart_id && ($action === 'increase' || $action === 'decrease')) {
    // Get current quantity
    $stmt = $pdo->prepare("SELECT quantity FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$cart_id, $_SESSION['user_id']]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        $quantity = $item['quantity'];
        if ($action === 'increase') {
            $quantity++;
        } elseif ($action === 'decrease' && $quantity > 1) {
            $quantity--;
        }
        $stmt = $pdo->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$quantity, $cart_id, $_SESSION['user_id']]);
    }
}
header("Location: cart-page.php");
exit();