<?php
session_start();
include "config.php";

if (isset($_SESSION['user'])) { header("Location: dashboard.php"); exit(); }

if (isset($_POST['signup'])) {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (strlen($name) < 3)                          $error = "Name must be at least 3 characters long.";
    elseif (preg_match('/[0-9]/', $name))           $error = "Name must not contain numbers.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error = "Please enter a valid email address.";
    elseif (strlen($password) < 8)                  $error = "Password must be at least 8 characters long.";
    elseif (!preg_match('/[A-Z]/', $password))      $error = "Password must contain at least 1 uppercase letter.";
    elseif (!preg_match('/[a-z]/', $password))      $error = "Password must contain at least 1 lowercase letter.";
    elseif (!preg_match('/[0-9]/', $password))      $error = "Password must contain at least 1 number.";
    elseif (!preg_match('/[@!$#%^&*]/', $password)) $error = "Password must contain at least 1 special character (@!$#...).";
    else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $error = "Email already registered!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt   = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed);
            if ($stmt->execute()) {
                $_SESSION['user']    = $name;
                $_SESSION['user_id'] = $conn->insert_id;
                header("Location: dashboard.php"); exit();
            } else { $error = "Signup failed! Please try again."; }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "partials/head.php"; ?>
    <style>
        body { background: #f0f2f5; }
        .auth-container { display: flex; justify-content: center; align-items: center; min-height: 85vh; padding: 20px; }
        .auth-card { background: #fff; border-radius: 16px; padding: 40px; width: 100%; max-width: 430px; box-shadow: 0 8px 32px rgba(0,0,0,0.10); }
        .auth-card .icon { font-size: 3rem; }
        .btn-auth { width: 100%; padding: 12px; background: #dc3545; color: #fff; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; transition: background 0.2s; }
        .btn-auth:hover { background: #bb2d3b; }
        label { margin-top: 14px; display: block; font-weight: 500; }
        input.form-control { margin-top: 4px; }
    </style>
</head>
<body>

<?php include "partials/navbar.php"; ?>

<div class="auth-container">
    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="icon">🚌</div>
            <h2>Create Account</h2>
            <p class="text-muted">Join GoGlide today</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Your Name" required class="form-control"
                   value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="you@email.com" required class="form-control"
                   value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required class="form-control">
            <button type="submit" name="signup" class="btn-auth mt-4">🚀 Sign Up</button>
        </form>

        <hr class="my-4">
        <p class="text-center mb-0">Already have an account? <a href="login.php">Login →</a></p>
    </div>
</div>

<?php include "partials/footer.php"; ?>
</body>
</html>