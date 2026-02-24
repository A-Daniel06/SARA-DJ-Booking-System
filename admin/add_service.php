<?php
session_start();
// Path to the JSON file
$json_file = __DIR__ . '/../services_data.json';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $service_name = trim($_POST['service_name']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  $date = date('Y-m-d');
  $new_service = [
    'service_name' => $service_name,
    'description' => $description,
    'price' => $price,
    'date' => $date
  ];
  $services = [];
  if (file_exists($json_file)) {
    $services = json_decode(file_get_contents($json_file), true) ?: [];
  }
  $services[] = $new_service;
  file_put_contents($json_file, json_encode($services, JSON_PRETTY_PRINT));
  $_SESSION['service_added'] = true;
  header('Location: add_service.php');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add DJ Service</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body {
  margin:0;
  font-family:'Segoe UI', Arial, sans-serif;
  background: linear-gradient(135deg, #232526 0%, #414345 100%);
  min-height:100vh;
}
.main-content {
  margin-left:270px;
  padding:40px 0 0 0;
  min-height:100vh;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
}
/* Colorful container with gradient and glass effect */
.card-form {
  background: linear-gradient(135deg, #43cea2 0%, #185a9d 50%, #7b2ff2 100%);
  background-blend-mode: overlay;
  border-radius:28px;
  box-shadow:0 12px 40px rgba(44,62,80,0.22);
    padding:40px 32px 40px 32px;
    max-width:520px;
    min-height:350px;
    width:90vw;
    margin:32px auto 0 auto;
  animation:fadeIn 0.7s;
  position:relative;
  overflow:hidden;
}
.card-form:before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(23, 235, 182, 0.82);
  border-radius: 18px;
  z-index: 0;
}
.card-form > * {
  position: relative;
  z-index: 1;
}
@keyframes fadeIn {
  from { opacity:0; transform:translateY(30px); }
  to { opacity:1; transform:translateY(0); }
}
.card-form h2 {
  text-align:center;
  color:#232526;
    font-size:1.7rem;
    margin-bottom:22px;
    gap:8px;
}
.form-group {
  margin-bottom:22px;
}
label {
  font-weight:800;
  color:#34495e;
  margin-bottom:14px;
  display:block;
    font-size:1rem;
    letter-spacing:0.5px;
}
input, textarea {
  width:100%;
    padding:10px 10px;
    border:2px solid #d1d5db;
    border-radius:16px;
    font-size:0.95rem;
    background:#f8fafc;
    color:#232526;
    transition:box-shadow 0.2s, border 0.2s;
    margin-top:4px;
    font-weight:600;
}
input:focus, textarea:focus {
  border-color:#f39c12;
  box-shadow:0 0 8px rgba(243,156,18,0.13);
  outline:none;
}
.add-btn {
  width:100%;
    padding:14px;
    background:linear-gradient(90deg,#f39c12,#e67e22);
    color:#fff;
    border:none;
    border-radius:16px;
    font-size:1rem;
    font-weight:900;
    cursor:pointer;
    letter-spacing:1px;
    box-shadow:0 4px 16px rgba(243,156,18,0.13);
    transition:background 0.2s, transform 0.18s;
    margin-top:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
}
.add-btn:hover {
  background:linear-gradient(90deg,#232526,#34495e);
  color:#f39c12;
  transform:scale(1.04);
}
@media (max-width: 900px) {
  .main-content {
    margin-left:0;
    padding:20px 0 0 0;
  }
}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar"><h1 style="margin:0; font-size:2rem; color:#f39c12; letter-spacing:1px;">Add DJ Service</h1></div>
<div class="main-content">
  <?php if (!empty($_SESSION['service_added'])): ?>
    <div style="background:#43cea2;color:#fff;padding:12px 18px;border-radius:10px;margin-bottom:18px;text-align:center;font-weight:bold;">Service added successfully!</div>
    <?php unset($_SESSION['service_added']); endif; ?>
  <form method="post" action="" class="card-form">
    <h2><i class="fa fa-music"></i> Add New Service</h2>
    <div class="form-group">
      <label for="service_name">Service Name</label>
      <input type="text" id="service_name" name="service_name" placeholder="Enter service name" required>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" rows="4" placeholder="Describe the service" required></textarea>
    </div>
    <div class="form-group">
      <label for="price">Price (₹)</label>
      <input type="number" id="price" name="price" placeholder="Enter price" min="0" required>
    </div>
    <button type="submit" class="add-btn"><i class="fa fa-plus"></i> Add Service</button>
  </form>
</div>
</body>
</html>
