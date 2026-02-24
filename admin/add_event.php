<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Add Event</title>
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
.card-form {
  background: linear-gradient(120deg, #f9d423 0%, #ff4e50 100%);
  background-blend-mode: overlay;
  border-radius:28px;
  box-shadow:0 12px 40px rgba(44,62,80,0.18);
  padding:48px 44px 38px 44px;
  max-width:600px;
  width:90vw;
  margin:40px auto 0 auto;
  animation:fadeIn 0.7s;
  position:relative;
  overflow:hidden;
}
.card-form:before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(255,255,255,0.82);
  border-radius: 28px;
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
  font-size:2.2rem;
  margin-bottom:28px;
  font-weight:900;
  letter-spacing:2px;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:12px;
}
.form-group {
  margin-bottom:28px;
}
label {
  font-weight:800;
  color:#34495e;
  margin-bottom:12px;
  display:block;
  font-size:1.2rem;
  letter-spacing:0.8px;
}
input, textarea {
  width:100%;
  padding:16px 14px;
  border:2px solid #d1d5db;
  border-radius:12px;
  font-size:1.1rem;
  background:#f8fafc;
  color:#232526;
  transition:box-shadow 0.2s, border 0.2s;
  margin-top:6px;
  font-weight:600;
}
input:focus, textarea:focus {
  border-color:#ff4e50;
  box-shadow:0 0 12px rgba(255,78,80,0.13);
  outline:none;
}
.add-btn {
  width:100%;
  padding:18px;
  background:linear-gradient(90deg,#f9d423,#ff4e50);
  color:#fff;
  border:none;
  border-radius:12px;
  font-size:1.3rem;
  font-weight:900;
  cursor:pointer;
  letter-spacing:1.2px;
  box-shadow:0 6px 24px rgba(255,78,80,0.13);
  transition:background 0.2s, transform 0.18s;
  margin-top:18px;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:10px;
}
.add-btn:hover {
  background:linear-gradient(90deg,#ff4e50,#f9d423);
  color:#232526;
  transform:scale(1.06);
}
@media (max-width: 900px) {
  .main-content {
    margin-left:0;
    padding:20px 0 0 0;
  }
  .card-form {
    max-width: 100vw;
    padding: 2vw 1vw 2vw 1vw;
  }
  .card-form h2 {
    font-size:1.3rem;
  }
  label {
    font-size:1rem;
  }
  input, textarea {
    font-size:0.95rem;
    padding:10px 8px;
  }
  .add-btn {
    font-size:1rem;
    padding:12px;
  }
}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar"><h1 style="margin:0; font-size:2rem; color:#ff4e50; letter-spacing:1px;">Add Event</h1></div>
<div class="main-content">
  <form method="post" action="" class="card-form">
    <h2><i class="fa fa-calendar-plus"></i> Add New Event</h2>
    <div class="form-group">
      <label for="event_name">Event Name</label>
      <input type="text" id="event_name" name="event_name" placeholder="Enter event name" required>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" rows="4" placeholder="Describe the event" required></textarea>
    </div>
    <button type="submit" class="add-btn"><i class="fa fa-plus"></i> Add Event</button>
  </form>
</div>
</body>
</html>
