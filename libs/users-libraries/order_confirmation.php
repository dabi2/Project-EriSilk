<?php
session_start();
include 'db_connection.php'; // $pdo

// Check if order_ref is passed
if (!isset($_GET['order_ref'])) {
    die("Invalid order reference.");
}

$order_ref = $_GET['order_ref'];

// Extract the numeric ID from reference
$order_id = str_replace('ORDER_', '', $order_ref);

// Fetch order details
$stmt_order = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
$stmt_order->execute([$order_id]);
$order = $stmt_order->fetch();

if (!$order) {
    die("Order not found.");
}

// Fetch order items
$stmt_items = $pdo->prepare("SELECT oi.*, p.name, p.image 
                             FROM order_items oi 
                             JOIN products p ON oi.product_id = p.id 
                             WHERE oi.order_id = ?");
$stmt_items->execute([$order_id]);
$order_items = $stmt_items->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="order_confirmation.css"> <!-- optional CSS -->
</head>
<body>
    <div class="order-confirmation">
    <h1>Thank you for your order!</h1>
    <p><strong>Order Reference:</strong> <?php echo htmlspecialchars($order_ref); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
    <p><strong>Total Amount:</strong> ₹<?php echo number_format($order['total_amount'], 2); ?></p>

    <h2>Shipping Information</h2>
    <p>
        <?php echo htmlspecialchars($order['full_name']); ?><br>
        <?php echo htmlspecialchars($order['email']); ?><br>
        <?php echo htmlspecialchars($order['phone']); ?><br>
        <?php echo htmlspecialchars($order['address'] ?? ''); ?>, 
        <?php echo htmlspecialchars($order['city'] ?? ''); ?>, 
        <?php echo htmlspecialchars($order['state'] ?? ''); ?> - 
        <?php echo htmlspecialchars($order['postal_code'] ?? ''); ?>
    </p>

    <h2>Order Items</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>"></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>₹<?php echo number_format($item['price'], 2); ?></td>
                    <td><span><?php echo $item['quantity']; ?></span></td>
                    <td>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="../index.php" class="btn">Continue Shopping</a>
</div>

</body>
</html>
