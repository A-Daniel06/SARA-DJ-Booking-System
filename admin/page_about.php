<?php 
session_start();
// include the project's mysqli connection (db.php is in project root)
include_once __DIR__ . '/../db.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit About Us</title>
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
  font-size: 2.4rem;
  font-weight: bold;
  letter-spacing: 1px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.1);
  margin-bottom: 32px;
}
.container {
  max-width: 900px;
  margin: 40px auto;
  background: #f4faff;
  border-radius: 24px;
  box-shadow: 0 8px 40px rgba(37,99,235,0.1);
  padding: 48px 40px;
}
form {
  background: #fff;
  padding: 40px 36px;
  border-radius: 16px;
  box-shadow: 0 2px 16px rgba(37,99,235,0.08);
  display: flex;
  flex-direction: column;
  gap: 24px;
  font-size: 1.15rem;
}
form label {
  font-weight: 600;
  color: #2563eb;
  font-size: 1.1rem;
}
form textarea {
  width: 100%;
  height: 250px;
  padding: 18px;
  border: 1.5px solid #2563eb;
  border-radius: 10px;
  font-size: 1.1rem;
  resize: none;
  color: #2563eb;
  background: #f4faff;
}
form button {
  padding: 14px;
  background: #22c55e;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1.15rem;
  font-weight: 700;
  transition: background 0.2s, transform 0.2s;
}
form button:hover {
  background: #15803d;
  transform: translateY(-2px);
}
.message {
  background: #22c55e;
  color: #fff;
  padding: 15px;
  margin-bottom: 20px;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  text-align: center;
}
</style>
</head>
<body>

<div class="topbar">Edit About Us Page</div>
<div class="container">

<?php
// If form submitted, update content
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  
  // Check if record exists
  $check = mysqli_query($conn, "SELECT * FROM pages WHERE page_name='about'");
  
  if (mysqli_num_rows($check) > 0) {
    $update = "UPDATE pages SET content='$content' WHERE page_name='about'";
  } else {
    $update = "INSERT INTO pages (page_name, content) VALUES ('about', '$content')";
  }
  
  if (mysqli_query($conn, $update)) {
    echo "<div class='message'>About Us Page Updated Successfully!</div>";
  } else {
    echo "<div class='message' style='background:#e74c3c;'>Error updating page!</div>";
  }
}

// Get current content
$result = mysqli_query($conn, "SELECT content FROM pages WHERE page_name='about'");
$row = mysqli_fetch_assoc($result);
$current_content = $row['content'] ?? "Welcome to SARA DJ Service – We bring energy, excitement, and unforgettable music to your events. Our DJs are professional, experienced, and passionate about making your celebration a success.";
?>

<form method="post" action="">
  <label>Edit About Us Content:</label>
  <textarea name="content"><?php echo htmlspecialchars($current_content); ?></textarea>
  <button type="submit">Save Changes</button>
</form>

</div>
</body>
</html>
