<?php
session_start();
include __DIR__ . "/config.php";

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Wrong password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . "/partials/head.php"; ?>
    <style>
        body { background: #f0f2f5; }
        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 85vh;
            padding: 20px;
        }
        .auth-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 430px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.10);
        }
        .auth-card .icon { font-size: 3rem; }
        .btn-auth {
            width: 100%;
            padding: 12px;
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-auth:hover { background: #bb2d3b; }
        label { margin-top: 14px; display: block; font-weight: 500; }
        input.form-control { margin-top: 4px; }
    </style>
</head>
<body>

<?php include __DIR__ . "/partials/navbar.php"; ?>

<div class="auth-container">
    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="icon">🚌</div>
            <h2>Welcome Back</h2>
            <p class="text-muted">Sign in to your GoGlide account</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="you@email.com" required class="form-control">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required class="form-control">
            <button type="submit" name="login" class="btn-auth mt-4">🔒 Sign In</button>
        </form>

        <hr class="my-4">
        <p class="text-center mb-0">Don't have an account? <a href="signup.php">Create one →</a></p>
    </div>
</div>

<?php include __DIR__ . "/partials/footer.php"; ?>
</body>
</html>
