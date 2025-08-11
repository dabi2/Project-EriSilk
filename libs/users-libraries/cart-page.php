<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: sections/authentication/login.php");
    exit();
}

// Example: Fetch cart items from database (replace with your logic)
$host = 'localhost';
$db   = 'riandlast';
$user = 'root';
$pass = '';
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT c.id, p.name, p.image, p.price, c.quantity 
                       FROM cart c 
                       JOIN products p ON c.product_id = p.id 
                       WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Cart | Eri Silk</title>
    <?php include '../sections/head.php'; ?>
    <link rel="stylesheet" href="../sections/authentication/style/login-style.css">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .cart-container {
            background: #fff;
            padding: 2.5rem 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 700px;
            margin: 2rem auto;
        }

        .cart-title {
            font-family: "Playfair Display", serif;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2.2rem;
            font-weight: 700;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        .cart-table th,
        .cart-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
            font-family: 'Montserrat', sans-serif;
        }

        .cart-table th {
            background: var(--light-color);
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .cart-table img {
            width: 60px;
            border-radius: 8px;
        }

        .cart-actions {
            text-align: right;
        }

        .cart-total {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 2rem;
            text-align: right;
        }

        .checkout-btn {
            background: var(--primary-color);
            color: #fff;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background var(--transition);
            float: right;
        }

        .checkout-btn:hover {
            background: var(--secondary-color);
            color: var(--primary-color);
        }

        .empty-cart {
            text-align: center;
            color: var(--text-color);
            font-size: 1.1rem;
            margin: 2rem 0;
        }
    </style>
</head>

<body>
    <div class="cart-container">
        <div class="cart-title"><i class="fas fa-shopping-cart"></i> Your Cart</div>
        <?php if (count($cart_items) === 0): ?>
            <div class="empty-cart">Your cart is empty.</div>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Product"></td>
                            <td>₹<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td>
                                <form method="post" action="remove_from_cart.php" style="display:inline;">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="login-btn" style="padding:0.4rem 1rem;font-size:0.95rem;">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-total">Total: ₹<?php echo number_format($total, 2); ?></div>
            <div class="cart-actions">
                <a href="checkout.php"><button class="checkout-btn">Proceed to Checkout</button></a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>