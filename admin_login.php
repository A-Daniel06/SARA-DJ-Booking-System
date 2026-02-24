<?php
session_start();
// Logout handler
if (isset($_GET['logout'])) {
    // session already started above
    session_unset();
    session_destroy();
    header('location:login.php');
    exit();
}
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - SARA DJ Booking</title>
    <style>
        :root{ --accent:#b04bd9; --panel-bg: rgba(6,6,6,0.55); --muted: rgba(255,255,255,0.75); }
        html,body{height:100%;}
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #0b0b0b;
            color: #fff;
        }

        .login-bg { position:relative; min-height:100vh; overflow:hidden; }
        .bg-image {
            position:absolute; inset:0; z-index:0;
            background: url('images/IMG-20251007-WA0014.jpg') no-repeat center center/cover;
            background-size: cover;
        }
        .bg-image::after{ content:''; position:absolute; inset:0; background: linear-gradient(180deg, rgba(6,6,6,0.55) 0%, rgba(6,6,6,0.65) 100%); }

        .hero-title { position:relative; z-index:1; text-align:center; padding-top:48px; color:#fff; font-size:34px; font-weight:700; letter-spacing:1px; text-shadow:0 6px 24px rgba(0,0,0,0.6); }

        .login-panel{ position:relative; z-index:1; display:flex; align-items:center; justify-content:center; min-height:calc(100vh - 160px); padding:40px 20px; }

        .container{ width:420px; position:relative; background: var(--panel-bg); border-radius:12px; padding:34px 30px; box-shadow:0 10px 40px rgba(2,6,23,0.6); border:1px solid rgba(255,255,255,0.04); color:#fff; }
        .container h3{ text-align:center; margin:0 0 18px 0; font-size:20px; color:var(--muted); }

        .brand { width:84px; height:84px; border-radius:50%; margin:0 auto 14px; background:rgba(255,255,255,0.06); display:flex; align-items:center; justify-content:center; color:var(--accent); font-weight:800; font-size:22px; box-shadow: inset 0 -6px 18px rgba(0,0,0,0.2); }

        .field { margin-bottom:18px; position:relative; }
        input[type=text], input[type=password] { width:100%; background:transparent; border:none; border-bottom:1px solid rgba(255,255,255,0.18); padding:12px 6px; color:#fff; font-size:15px; }
        input::placeholder{ color: rgba(255,255,255,0.6); }
        input:focus{ outline:none; border-bottom-color: var(--accent); box-shadow: 0 4px 18px rgba(176,75,217,0.08); }

        .actions{ display:flex; gap:12px; align-items:center; margin-top:8px; }
        .actions .remember{ color:rgba(255,255,255,0.85); font-size:13px; }

        .btn-primary{ width:100%; padding:12px; background:var(--accent); border:none; color:#fff; font-weight:700; border-radius:6px; cursor:pointer; margin-top:12px; box-shadow:0 10px 30px rgba(176,75,217,0.12); }
        .btn-primary:hover{ filter:brightness(0.95); transform:translateY(-2px); }

    .btn-secondary{ display:block; width:100%; padding:10px; margin-top:12px; background:transparent; border:1px solid rgba(255,255,255,0.12); color:rgba(255,255,255,0.9); border-radius:6px; text-decoration:none; text-align:center; }
    .btn-secondary:hover{ background:rgba(255,255,255,0.03); }

        .clearfix{ text-align:center; margin-top:14px; }
        .forgot { color:rgba(255,255,255,0.85); text-decoration:underline; font-size:14px; }
        .footer-text{ color:rgba(255,255,255,0.6); font-size:13px; text-align:center; margin-top:14px; }

        @media (max-width:600px){ .container{ width:92vw; padding:22px; } .hero-title{ font-size:24px; padding-top:28px; } }
    </style>
</head>
<body>
<div class="login-bg">
    <div class="bg-image"></div>
    <div class="hero-title">Admin Login Form</div>
    <div class="login-panel">
        <div class="container">
            <div class="brand">S</div>
            <h3>Login Form</h3>
            <form method="post" action="">
                <div class="field"><input type="text" name="username" placeholder="User Name" required></div>
                <div class="field"><input type="password" name="password" placeholder="Password" required></div>
                <div class="actions">
                    <label class="remember"><input type="checkbox" name="remember" style="margin-right:8px;">Remember me ?</label>
                </div>
                <button type="submit" name="login" class="btn-primary">Login</button>
                <div class="clearfix"><a class="forgot" href="admin_reset_password.php">Forgot password?</a></div>
                <a href="index.php" class="btn-secondary">Back to Home</a>
                <div class="footer-text">© 2025 SARA DJ Booking</div>
            </form>
        </div>
    </div>
</div>

<?php
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
