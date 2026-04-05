<?php
session_start();
include __DIR__ . "/config.php";

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Email already registered!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['user'] = $name;
            $_SESSION['user_id'] = $conn->insert_id;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Signup failed! Please try again.";
        }
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
            <h2>Create Account</h2>
            <p class="text-muted">Join GoGlide today</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Your Name" required class="form-control">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="you@email.com" required class="form-control">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required class="form-control">
            <button type="submit" name="signup" class="btn-auth mt-4">🚀 Sign Up</button>
        </form>

        <hr class="my-4">
        <p class="text-center mb-0">Already have an account? <a href="login.php">Login →</a></p>
    </div>
</div>

<?php include __DIR__ . "/partials/footer.php"; ?>
</body>
</html>
