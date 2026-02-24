<?php
session_start();
include_once "db.php"; // ensure correct path

if (isset($_POST['reset'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($new_pass !== $confirm_pass) {
        $msg = "❌ Passwords do not match!";
    } else {
        $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password='$hashed_password' WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_affected_rows($conn) > 0) {
            $msg = "✅ Password reset successfully!";
        } else {
            $msg = "⚠️ Username not found!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Reset Password - SARA DJ</title>
<style>
/* --- Page Layout --- */
body {
    font-family: 'Poppins', 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* --- Container --- */
.container {
    background: #ffffff;
    padding: 40px 35px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    width: 400px;
    max-width: 90vw;
    text-align: center;
    animation: fadeIn 0.8s ease-in-out;
}

/* --- Heading --- */
h2 {
    color: #333;
    font-size: 26px;
    margin-bottom: 20px;
    font-weight: 700;
    letter-spacing: 1px;
}

/* --- Message Box --- */
.msg {
    margin: 10px 0 20px 0;
    padding: 12px 18px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.05);
}
.msg.success {
    background-color: #dcfce7;
    color: #15803d;
    border-left: 5px solid #22c55e;
}
.msg.error {
    background-color: #fee2e2;
    color: #b91c1c;
    border-left: 5px solid #ef4444;
}

/* --- Input Fields --- */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 15px;
    border: 1.5px solid #d1d5db;
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #f9fafb;
}
input[type="text"]:focus,
input[type="password"]:focus {
    outline: none;
    border-color: #4e54c8;
    box-shadow: 0 0 6px rgba(78,84,200,0.3);
    background: #fff;
}

/* --- Button --- */
button {
    background: linear-gradient(90deg, #4e54c8, #8f94fb);
    color: #fff;
    border: none;
    padding: 12px 16px;
    width: 100%;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(78,84,200,0.3);
}
button:hover {
    background: linear-gradient(90deg, #8f94fb, #4e54c8);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(78,84,200,0.4);
}

/* --- Footer Text --- */
.footer-text {
    font-size: 13px;
    margin-top: 18px;
    color: #6b7280;
}
.footer-text a {
    color: #4e54c8;
    text-decoration: none;
    font-weight: 600;
}
.footer-text a:hover {
    text-decoration: underline;
}

/* --- Animation --- */
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
</style>
</head>
<body>
<div class="container">
    <h2>🔒 Reset Password</h2>
    
    <?php if(!empty($msg)) { ?>
        <div class="msg <?php echo (strpos($msg,'✅')!==false)?'success':'error'; ?>">
            <?php echo htmlspecialchars($msg); ?>
        </div>
    <?php } ?>

    <form method="post">
        <input type="text" name="username" placeholder="Enter your username" required>
        <input type="password" name="new_password" placeholder="Enter new password" required>
        <input type="password" name="confirm_password" placeholder="Confirm new password" required>
        <button type="submit" name="reset">Reset Password</button>
    </form>
    <div class="footer-text">
        <p>Back to <a href="login.php">Login</a></p>
    </div>
</div>
</body>
</html>
