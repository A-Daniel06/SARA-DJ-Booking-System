<?php
session_start();
include_once "db.php"; // make sure this path is correct

if (isset($_POST['reset'])) {
    // Escape form inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($new_pass !== $confirm_pass) {
        $msg = "❌ Passwords do not match!";
    } else {
        // Hash the password before saving
        $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

        // Update user password by username
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
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right,#6a11cb,#2575fc);
    margin:0;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.container {
    background:#fff;
    padding:30px;
    border-radius:12px;
    box-shadow:0 6px 18px rgba(0,0,0,0.18);
    width:380px;
    max-width:95vw;
}
h2 {
    color:#2c3e50;
    margin-bottom:18px;
    text-align:center;
}
.form-row {
    display:flex;
    flex-direction:column;
    gap:12px;
    align-items:stretch;
    margin-bottom:6px;
}
input[type="text"], input[type="password"] {
    width:100%;
    padding:12px 14px;
    border:1px solid #dcdcdc;
    border-radius:8px;
    font-size:14px;
}
button {
    background:#2575fc;
    color:#fff;
    border:none;
    padding:12px 16px;
    width:100%;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
    font-weight:600;
}
button:hover {
    background:#1d5ed0;
    transform:translateY(-1px);
}
.msg {
    margin:12px 0;
    font-size:14px;
    color:#c0392b;
    text-align:center;
}
.success {
    color:#27ae60;
}
</style>
</head>
<body>
<div class="container">
    <h2>Reset Password</h2>
    <?php if(!empty($msg)) { ?>
        <p class="msg <?php echo (strpos($msg,'✅')!==false)?'success':''; ?>">
            <?php echo htmlspecialchars($msg); ?>
        </p>
    <?php } ?>
    <form method="post">
        <div class="form-row">
            <input type="text" name="username" placeholder="Enter your username" required>
            <input type="password" name="new_password" placeholder="Enter new password" required>
            <input type="password" name="confirm_password" placeholder="Confirm new password" required>
        </div>
        <button type="submit" name="reset">Reset Password</button>
    </form>
</div>
</body>
</html>
