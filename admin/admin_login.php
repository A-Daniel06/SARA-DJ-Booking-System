<?php
// Logout handler
if (isset($_GET['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    header('location:login.php');
    exit();
}
include("db.php");

$error = '';

session_start();
if (isset($_POST['login'])) {
    $u = isset($_POST['username']) ? trim($_POST['username']) : '';
    $p = isset($_POST['password']) ? trim($_POST['password']) : '';
    if ($u === 'admin' && $p === 'admin123') {
        $_SESSION['admin_login_success'] = true;
        echo "<script>window.location='admin_dashboard.php';</script>";
        exit();
    } else {
        $error = 'Invalid credentials. Please check username and password.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - SARA DJ Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #222;
        }

        .login-bg {
            display: flex;
            min-height: 100vh;
        }
        .bg-image {
            flex: 1.2;
            background: url('images/why.jpg') no-repeat center center/cover;
            position: relative;
        }
        .bg-image::after {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(30,30,30,0.45);
        }
        .login-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            min-width: 350px;
            box-shadow: -2px 0 16px rgba(44,62,80,0.08);
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 36px 32px 28px 32px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.13);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 25px rgba(0,0,0,0.18);
        }

        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
            font-size: 22px;
            letter-spacing: 1px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #2c3e50;
            outline: none;
            box-shadow: 0px 0px 5px rgba(44, 62, 80, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }

        button:hover {
            background: #1a252f;
            transform: scale(1.05);
        }

        .footer-text {
            margin-top: 15px;
            font-size: 13px;
            color: #666;
        }
        .back-home-btn {
            display: inline-block;
            margin-top: 18px;
            padding: 10px 28px;
            background: #00b894;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
            transition: background 0.3s, transform 0.3s;
        }
        .back-home-btn:hover {
            background: #0984e3;
            color: #fff;
            transform: scale(1.07);
        }
            .message { padding:10px; margin-bottom:12px; border-radius:6px; }
            .error { background:#ffe6e6; color:#b30000; border:1px solid #ffb3b3; }
        /* Responsive tweaks */
        @media (max-width: 900px) {
            .login-bg { flex-direction: column; }
            .bg-image { min-height: 220px; height: 220px; flex: none; }
            .login-panel { min-width: unset; box-shadow: none; }
            .container { max-width: 98vw; padding: 18px 4vw 18px 4vw; }
        }
    </style>
</head>
<body>
<div class="login-bg">
    <div class="bg-image">
        <div style="position:absolute;bottom:30px;left:30px;color:#fff;z-index:2;font-size:1.3rem;letter-spacing:1px;text-shadow:0 2px 8px #000;">
            <b>Online DJ Management System.</b><br>
            <span style="font-size:0.95rem;">Copyright © 2020-25</span>
        </div>
    </div>
    <div class="login-panel">
        <div class="container">
            <h2>Admin Login</h2>
            <?php if ($error): ?>
                <div class="message error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="post" action="">
                <input type="text" name="username" placeholder="Admin Username" required>
                <input type="password" name="password" placeholder="Admin Password" required>
                <button type="submit" name="login">Login</button>
                <button type="reset" style="background:#f39c12; color:#fff; margin-top:10px;">Clear Fields</button>
                <br>
                <a href="admin_reset_password.php" style="display:inline-block;margin-top:12px;background:#e17055;color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:bold;transition:background 0.3s;">Forgot/Reset Password?</a>
            </form>
            <a href="index.php" class="back-home-btn">Back to Home</a>
            <p class="footer-text">© 2025 SARA DJ Booking</p>
        </div>
    </div>
</div>
        @media (max-width: 900px) {
            .login-bg { flex-direction: column; }
            .bg-image { min-height: 220px; height: 220px; flex: none; }
            .login-panel { min-width: unset; box-shadow: none; }
            .container { max-width: 98vw; padding: 18px 4vw 18px 4vw; }
        }

<?php
session_start();
if (isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];
    if ($u == "admin" && $p == "admin123") {
        $_SESSION['admin_login_success'] = true;
        echo "<script>window.location='admin/admin_dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>
</body>
</html>
