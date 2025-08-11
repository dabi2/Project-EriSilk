<?php
session_start();
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Example: Validate and "register" user (replace with real DB logic)
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (!$username || !$email || !$password || !$confirm) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        // TODO: Save user to database, check for duplicates, hash password
        $success = 'Account created successfully! You can now <a href="login.php">login</a>.';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>


    <style>
        .login-title {
            font-family: 'Playfair Display', serif;
            color: var(--secondary-color);
            letter-spacing: 1px;
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 2rem;
        }

        .login-form label {
            font-family: 'Montserrat', sans-serif;
            color: var(--primary-color);
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .login-form input {
            background: #f9f5f0;
            border: 1.5px solid var(--primary-color);
            color: var(--dark-color);
            font-family: 'Montserrat', sans-serif;
            font-size: 1.05rem;
        }

        .login-form input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 2px rgba(180, 140, 90, 0.15);
        }

        .login-btn {
            background: linear-gradient(90deg, var(--primary-color) 60%, var(--secondary-color) 100%);
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(180, 140, 90, 0.08);
        }

        .login-btn:hover {
            background: var(--secondary-color);
            color: var(--primary-color);
        }

        .login-links a {
            font-family: 'Montserrat', sans-serif;
            color: var(--secondary-color);
            font-weight: 700;
            font-size: 1rem;
        }

        .login-error {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.05rem;
            border-left: 4px solid var(--secondary-color);
        }
    </style>

    <meta charset="UTF-8">
    <title>Create Account | Eri Silk</title>
    <link rel="stylesheet" href="../../sections/authentication/style/login-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="login-container">
        <div class="login-title"><i class="fas fa-user-plus"></i> Create Account</div>
        <?php if ($error): ?>
            <div class="login-error"><?php echo htmlspecialchars($error); ?></div>
        <?php elseif ($success): ?>
            <div class="login-error" style="color: var(--primary-color); background: #f9f5f0;"><?php echo $success; ?></div>
        <?php endif; ?>
        <form class="login-form" method="post" autocomplete="off">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <button type="submit" class="login-btn">Create Account</button>
        </form>
        <div class="login-links">
            <a href="login.php">Already have an account? Login</a>
        </div>
    </div>
</body>

</html>