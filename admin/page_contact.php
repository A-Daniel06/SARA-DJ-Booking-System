<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Contact Us</title>
<style>
body {
  margin: 0;
  font-family: 'Segoe UI', Arial, sans-serif;
  background: #eaf3fb;
  min-height: 100vh;
}
.topbar {
  background: #2563eb;
  color: #fff;
  padding: 32px 0 24px 0;
  text-align: center;
  font-size: 2.8rem;
  font-weight: bold;
  letter-spacing: 2px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.10);
  margin-bottom: 32px;
}
.container {
  max-width: 900px;
  margin: 40px auto 0 auto;
  background: #f4faff;
  border-radius: 24px;
  box-shadow: 0 8px 40px rgba(37,99,235,0.10);
  padding: 48px 40px 40px 40px;
  min-height: 400px;
  display: flex;
  flex-direction: column;
  align-items: center;
}
form {
  background: #fff;
  padding: 40px 36px 32px 36px;
  border-radius: 16px;
  box-shadow: 0 2px 16px rgba(37,99,235,0.08);
  display: flex;
  flex-direction: column;
  align-items: stretch;
  gap: 24px;
  font-size: 1.25rem;
  width: 100%;
  max-width: 700px;
}
form label {
  font-weight: 600;
  color: #2563eb;
  font-size: 1.2rem;
  margin-bottom: 8px;
}
form textarea {
  width: 100%;
  height: 220px;
  padding: 18px;
  border: 1.5px solid #2563eb;
  border-radius: 10px;
  font-size: 1.18rem;
  resize: none;
  color: #2563eb;
  background: #f4faff;
  font-family: 'Segoe UI', Arial, sans-serif;
}
form button {
  margin-top: 18px;
  padding: 16px 0;
  background: #22c55e;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1.25rem;
  font-weight: 700;
  box-shadow: 0 2px 8px rgba(34,197,94,0.10);
  transition: background 0.2s, transform 0.2s;
  width: 100%;
}
form button:hover {
  background: #15803d;
  color: #fff;
  transform: translateY(-2px) scale(1.04);
}
.message {
  background: #22c55e;
  color: #fff;
  padding: 18px 32px;
  margin-bottom: 24px;
  border-radius: 10px;
  font-size: 1.18rem;
  font-weight: 600;
  box-shadow: 0 2px 8px rgba(34,197,94,0.10);
  text-align: center;
  letter-spacing: 1px;
  max-width: 600px;
  margin-left: auto;
  margin-right: auto;
}
@media (max-width: 900px) {
  .container { padding: 24px 6vw; }
  .topbar { font-size: 2rem; }
  form { padding: 18px 4vw; font-size: 1rem; }
  form textarea { font-size: 1rem; }
}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar"><h1>Edit Contact Us Page</h1></div>
<div class="container">
  <?php
  if($_SERVER['REQUEST_METHOD']=="POST"){
    $content=$_POST['content'];
    echo "<div class='message'>Contact Us Page Updated Successfully!</div>";
  }
  ?>
  <form method="post" action="">
    <label>Edit Contact Information:</label><br><br>
    <textarea name="content">SARA DJ Services
Phone: +91 9876543210
Email: info@saradjs.com
Address: Mumbai, Maharashtra, India</textarea>
    <button type="submit">Save</button>
  </form>
</div>
</body>
</html>
