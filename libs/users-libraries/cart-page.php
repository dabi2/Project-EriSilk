<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: sections/authentication/login.php");
    exit();
}
$host = 'localhost';
$db   = 'riandlast';
$user = 'root';
$pass = '';
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$pdo = new PDO($dsn, $user, $pass);

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT c.id, p.name, p.image, p.price, c.quantity 
                       FROM cart c 
                       JOIN products p ON c.product_id = p.id 
                       WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'] * $item['quantity'];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="UTF-8">
    <title>Your Cart | Eri Silk</title>
    <?php include '../sections/head.php'; ?>
    <link rel="stylesheet" href="cart-page.css">
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
                            <td><img src="../<?php echo htmlspecialchars($item['image']); ?>" alt="Product image" width="60"></td>
                            <td>₹<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <form class="form-cart-container" method="post" action="update_cart_quantity.php" style="display:inline-flex; align-items:center;">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" name="action" value="decrease" class="qty-btn">-</button>
                                    <span><?php echo $item['quantity']; ?></span>
                                    <button type="submit" name="action" value="increase" class="qty-btn">+</button>
                                </form>
                            </td>

                            <td>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td>
                                <form method="post" action="remove_from_cart.php" class="remove-form" style="display:inline;">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="login-btn remove-btn" style="padding:0.4rem 1rem;font-size:0.95rem;" data-id="<?php echo $item['id']; ?>">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="cart-total">Total: ₹<?php echo number_format($total, 2); ?></div>
            <div class="cart-actions">
                <form id="checkout-form" method="post" action="order.php">
                    <input type="hidden" name="cart_data" value="<?php echo htmlspecialchars(json_encode($cart_items)); ?>">
                    <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                </form>
            </div>



        <?php endif; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".remove-form").forEach(form => {
                form.addEventListener("submit", function(e) {
                    e.preventDefault();
                    let row = form.closest("tr");
                    let formData = new FormData(form);

                    Swal.fire({
                        title: 'Remove item?',
                        text: "Are you sure you want to remove this product from your cart?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, remove it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("remove_from_cart.php", {
                                    method: "POST",
                                    body: formData
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.status === "success") {
                                        // Get subtotal of removed item
                                        let subtotalCell = row.querySelector("td:nth-child(5)");
                                        let subtotalValue = parseFloat(subtotalCell.textContent.replace(/[^0-9.-]+/g, ""));

                                        // Remove row
                                        row.remove();

                                        // Update total
                                        let totalEl = document.querySelector(".cart-total");
                                        if (totalEl) {
                                            let currentTotal = parseFloat(totalEl.textContent.replace(/[^0-9.-]+/g, ""));
                                            let newTotal = currentTotal - subtotalValue;

                                            if (newTotal <= 0) {
                                                // Cart empty state
                                                document.querySelector(".cart-table").remove();
                                                totalEl.remove();

                                                let cartActions = document.querySelector(".cart-actions");
                                                if (cartActions) cartActions.remove();

                                                let emptyMessage = document.createElement("div");
                                                emptyMessage.className = "empty-cart";
                                                emptyMessage.textContent = "Your cart is empty.";
                                                document.querySelector(".cart-container").appendChild(emptyMessage);
                                            } else {
                                                totalEl.textContent = "Total: ₹" + newTotal.toFixed(2);
                                            }
                                        }

                                        Swal.fire({
                                            title: 'Removed!',
                                            text: 'The product has been removed from your cart.',
                                            icon: 'success',
                                            timer: 1500,
                                            showConfirmButton: false
                                        });
                                    } else {
                                        Swal.fire('Error', 'Something went wrong.', 'error');
                                    }
                                })
                                .catch(() => {
                                    Swal.fire('Error', 'Request failed.', 'error');
                                });
                        }
                    });
                });
            });
        });

        let totalAmount = cartData.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        // 1️⃣ Check if user is logged in
        <?php if (!isset($_SESSION['user_id'])): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Not Logged In',
                text: 'Please log in to proceed to checkout.',
                showCancelButton: true,
                confirmButtonText: 'Login',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.php'; // Redirect to login page
                }
            });
            return; // Stop further actions if not logged in
        <?php endif; ?>


        // check out sections
        const cartRows = document.querySelectorAll('.cart-table tbody tr');

        if (cartRows.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Your cart is empty!',
                text: 'Please add some products before proceeding to checkout.',
                confirmButtonText: 'OK'
            });
            return;
        }

        //     Swal.fire({
        //         title: 'Proceed to Checkout?',
        //         text: "You'll be redirected to the checkout page.",
        //         icon: 'question',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, proceed',
        //         cancelButtonText: 'Cancel'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             document.getElementById('checkout-form').submit();
        //         }
        //     });
        // });
    </script>


</body>



</html>