<?php
include("db.php");

$error = '';
$success = '';

// Handle registration
if (isset($_POST['register'])) {
    $u = mysqli_real_escape_string($conn, trim($_POST['new_username']));
    $p = mysqli_real_escape_string($conn, trim($_POST['new_password']));

    if ($u === '' || $p === '') {
        $error = 'Username and password are required for registration.';
    } else {
        // Check if username already exists
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$u'");
        if (mysqli_num_rows($check) > 0) {
            $error = 'Username already exists. Please choose another.';
        } else {
            // Hash the password
            $hashed_password = password_hash($p, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO users(username,password) VALUES('$u','$hashed_password')");
            $success = 'Registration successful! You can now login.';
        }
    }
}

// Handle login
if (isset($_POST['login'])) {
    $u = mysqli_real_escape_string($conn, trim($_POST['username']));
    $p = mysqli_real_escape_string($conn, trim($_POST['password']));

    $res = mysqli_query($conn, "SELECT * FROM users WHERE username='$u'");
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (password_verify($p, $row['password'])) {
            // Successful login
            echo "<script>window.location='index.php';</script>";
            exit;
        } else {
            $error = 'Invalid credentials. Please check your username and password.';
        }
    } else {
        $error = 'Invalid credentials. Please check your username and password.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login - SARA DJ Booking</title>
    <style>
        body { font-family: Arial; background:#f2f2f2; }
        .container { width:400px; margin:50px auto; padding:20px; background:#fff; border-radius:10px; }
        input { width:100%; padding:10px; margin:8px 0; border:1px solid #ccc; border-radius:5px; }
        button { background:#333; color:#fff; padding:10px; border:none; border-radius:5px; cursor:pointer; }
        button:hover { background:#555; }
        .message { padding:10px; margin-bottom:12px; border-radius:5px; }
        .error { background:#ffe6e6; color:#b30000; border:1px solid #ffb3b3; }
        .success { background:#e6ffe6; color:#007a00; border:1px solid #b3ffb3; }
    </style>
</head>
<body>
<div class="container">
    <h2>User Login</h2>

    <?php if ($error): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="message success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <h3>New User? Register Here</h3>
    <form method="post" action="">
        <input type="text" name="new_username" placeholder="Choose Username" required>
        <input type="password" name="new_password" placeholder="Choose Password" required>
        <button type="submit" name="register">Register</button>
    </form>
</div>
</body>
</html>
