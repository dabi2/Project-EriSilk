<?php
session_start();
$user_info = null;
if (isset($_SESSION['user_id'])) {
    // Database connection
    $host = 'localhost';
    $db   = 'riandlast';
    $user = 'root';
    $pass = '';
    $dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    try {
        $pdo = new PDO($dsn, $user, $pass);
        $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle error or show guest links
    }
}
?>
<!-- Header with Navigation -->
<header class="header">
    <div class="container">
        <div class="header-inner">
            <div class="logo">
                <a href="#">
                    <span class="eri">ERI</span><span class="silk">SILK</span>
                </a>
            </div>
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="#collections" class="nav-link">Collections</a></li>
                    <li class="nav-item"><a href="#customize" class="nav-link">Customize</a></li>
                    <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                </ul>
            </nav>
            <div class="header-icons">
                <a href="#" class="icon-link"><i class="fas fa-search"></i></a>
                <?php if ($user_info): ?>
                    <span class="icon-link" style="color:var(--primary-color);font-weight:600;">
                        <i class="fas fa-user"></i> Welcome, <?php echo htmlspecialchars($user_info['username']); ?>!
                    </span>
                    <a href="sections/authentication/logout.php" class="icon-link" style="color:var(--secondary-color);font-weight:700;">Logout</a>
                <?php else: ?>
                    <a href="sections/authentication/login.php" class="icon-link"><i class="fas fa-user"></i></a>
                <?php endif; ?>
                <a href="users-libraries/cart-page.php" class="icon-link cart-icon"><i class="fas fa-shopping-bag"></i><span class="cart-count">0</span></a>
            </div>
            <button class="hamburger">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>
    </div>
</header>