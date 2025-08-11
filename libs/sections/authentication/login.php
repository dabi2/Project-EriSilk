<?php

session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dummy authentication for demonstration
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    // Replace this with your real authentication logic
    if ($username === 'user' && $password === 'password') {
        $_SESSION['user_id'] = 1; // Example user ID
        header('Location: ../../account.php');
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Eri Silk</title>
    <link rel="stylesheet" href="../../style/index.css">
    <link rel="stylesheet" href="../../sections/authentication/style/login-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   
</head>
<body>
    <div class="login-container">
        <div class="login-title"><i class="fas fa-user"></i> Login to Eri Silk</div>
        <?php if ($error): ?>
            <div class="login-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form class="login-form"  method="post" autocomplete="off">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required autofocus>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="login-links">
            <a href="#">Forgot Password?</a> | 
            <a href="create_account.php">Create Account</a>
        </div>
    </div>
</body>
</html>