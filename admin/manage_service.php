<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Services</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body {
  margin:0;
  font-family:'Segoe UI', Arial, sans-serif;
  background: linear-gradient(135deg, #43cea2 0%, #185a9d 50%, #7b2ff2 100%);
  min-height:100vh;
}
.main-content {
  margin-left:270px;
  padding:60px 0 0 0;
  min-height:100vh;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:flex-start;
}
.service-card {
  background: linear-gradient(120deg, #f9d423 0%, #ff4e50 100%);
  background-blend-mode: overlay;
  border-radius:28px;
  box-shadow:0 12px 40px rgba(44,62,80,0.18);
  padding:48px 44px 38px 44px;
  max-width:950px;
  width:95vw;
  margin:40px auto 0 auto;
  animation:fadeIn 0.7s;
  position:relative;
  overflow-x:auto;
}
@keyframes fadeIn {
  from { opacity:0; transform:translateY(30px); }
  to { opacity:1; transform:translateY(0); }
}
table {
  width:100%;
  border-collapse:separate;
  border-spacing:0;
  background:transparent;
  font-size:1.25rem;
  margin-top:0;
}
th, td {
  padding:22px 18px;
  border-bottom:2.5px solid #e0e7ef;
  text-align:left;
  font-size:1.15rem;
}
th {
  background:transparent;
  color:#232526;
  font-size:1.3rem;
  font-weight:800;
  letter-spacing:1px;
  border-top-left-radius:18px;
  border-top-right-radius:18px;
  border-bottom:4px solid #36d1c4;
}
tr:last-child td {
  border-bottom:none;
}
tr {
  transition:background 0.18s;
}
tr:hover td {
  background:rgba(67,206,162,0.08);
}
.action-btn {
  padding:10px 18px;
  border:none;
  border-radius:8px;
  cursor:pointer;
  font-size:1.1rem;
  font-weight:700;
  margin-right:8px;
  transition:background 0.18s, color 0.18s, transform 0.15s;
  display:inline-flex;
  align-items:center;
  gap:7px;
}
.edit {
  background:linear-gradient(90deg,#27ae60,#43cea2);
  color:#fff;
}
.edit:hover {
  background:linear-gradient(90deg,#43cea2,#27ae60);
  color:#fff;
  transform:scale(1.07);
}
.delete {
  background:linear-gradient(90deg,#e74c3c,#ff5e62);
  color:#fff;
}
.delete:hover {
  background:linear-gradient(90deg,#ff5e62,#e74c3c);
  color:#fff;
  transform:scale(1.07);
}
@media (max-width: 1100px) {
  .service-card {
    max-width:99vw;
    padding:18px 4vw 18px 4vw;
  }
  table, th, td {
    font-size:1rem;
    padding:12px 6px;
  }
}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar"><h1 style="margin:0; font-size:2.2rem; color:#43cea2; letter-spacing:1.5px;">Manage DJ Services</h1></div>
<div class="main-content">
  <div class="service-card">
    <table id="serviceTable">
      <tr><th>ID</th><th>Service Name</th><th>Price</th><th>Creation Date</th><th>Actions</th></tr>
      <?php
      $json_file = __DIR__ . '/../services_data.json';
      $services = [];
      if (file_exists($json_file)) {
        $services = json_decode(file_get_contents($json_file), true) ?: [];
      }
      foreach ($services as $i => $service):
      ?>
      <tr>
        <td><?php echo $i+1; ?></td>
        <td><?php echo htmlspecialchars($service['service_name']); ?></td>
        <td>₹<?php echo htmlspecialchars($service['price']); ?></td>
        <td><?php echo htmlspecialchars($service['date']); ?></td>
        <td>
          <button class="action-btn delete" data-id="<?php echo $i; ?>"><i class="fa fa-trash"></i> Delete</button>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
</style>
<script>
// Delete functionality with persistent update
document.addEventListener('DOMContentLoaded', function() {
  const table = document.getElementById('serviceTable');
  table.addEventListener('click', function(e) {
    const btn = e.target.closest('.delete');
    if (btn) {
      const row = btn.closest('tr');
      const id = btn.getAttribute('data-id');
      if (confirm('Are you sure you want to delete this service?')) {
        fetch('manage_service.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'delete_id=' + encodeURIComponent(id)
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            alert('Failed to delete service.');
          }
        });
      }
    }
  });
});
</script>
  </div>
</div>
<?php
// Handle delete request (AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
  $json_file = __DIR__ . '/../services_data.json';
  $services = [];
  if (file_exists($json_file)) {
    $services = json_decode(file_get_contents($json_file), true) ?: [];
  }
  $delete_id = intval($_POST['delete_id']);
  if (isset($services[$delete_id])) {
    array_splice($services, $delete_id, 1);
    file_put_contents($json_file, json_encode($services, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true]);
    exit();
  }
  echo json_encode(['success' => false]);
  exit();
}
?>
</body>
</html>
