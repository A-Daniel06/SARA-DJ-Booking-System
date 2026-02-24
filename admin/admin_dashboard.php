
<?php session_start();
if (isset($_SESSION['admin_login_success'])) {
  echo "<script>alert('Admin Login Successful');</script>";
  unset($_SESSION['admin_login_success']);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard - SARA DJ</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body {
  margin:0;
  font-family:'Segoe UI', Arial, sans-serif;
  background: linear-gradient(135deg, #f5f6fa 60%, #e0e7ff 100%);
  min-height:100vh;
}

/* Sidebar (imported from sidebar.php) */
.sidebar {
  position:fixed;
  top:0; left:0;
  width:250px;
  height:100%;
  background:linear-gradient(135deg, #232526 0%, #414345 100%);
  color:#fff;
  box-shadow:2px 0 16px rgba(0,0,0,0.18);
  overflow-y:auto;
  border-top-right-radius:18px;
  border-bottom-right-radius:18px;
  z-index:100;
}
.sidebar-header {
  display:flex;
  flex-direction:column;
  align-items:center;
  margin-bottom:18px;
}
.sidebar-logo {
  width:70px;
  height:70px;
  border-radius:50%;
  object-fit:cover;
  margin-bottom:10px;
  box-shadow:0 2px 8px rgba(0,0,0,0.18);
  border:3px solid #f39c12;
}
.sidebar h2 {
  text-align:center;
  margin-bottom:0;
  font-size:22px;
  color:#f39c12;
  letter-spacing:1px;
  font-weight:700;
  text-shadow:0 2px 8px rgba(0,0,0,0.12);
}
.sidebar ul {
  list-style:none;
  padding:0;
  margin:0;
}
.sidebar ul li {
  padding:0;
  margin-bottom:2px;
  border-radius:8px;
  transition:background 0.2s;
}
.sidebar ul li a {
  color:#ecf0f1;
  text-decoration:none;
  display:flex;
  align-items:center;
  font-size:16px;
  padding:13px 28px;
  border-radius:8px;
  transition:background 0.2s, color 0.2s, padding-left 0.2s;
  position:relative;
}
.sidebar ul li a:hover, .sidebar ul li a:focus {
  background:rgba(243,156,18,0.13);
  color:#f39c12;
  padding-left:38px;
}
.sidebar ul li.active > a {
  background:#f39c12;
  color:#fff;
  font-weight:600;
}
.dropdown > a:after {
  content: '';
  border: solid #f39c12;
  border-width: 0 2px 2px 0;
  display: inline-block;
  padding: 3px;
  margin-left: 8px;
  transform: rotate(45deg);
  transition:transform 0.2s;
}
.dropdown.open > a:after {
  transform: rotate(-135deg);
}
.submenu {
  display:none;
  padding-left:18px;
  background:rgba(255,255,255,0.03);
  border-radius:0 0 8px 8px;
  animation:fadeIn 0.3s;
}
.dropdown.open > .submenu {
  display:block;
  animation:slideDown 0.3s;
}
.submenu li {
  padding:0;
}
.submenu li a {
  font-size:15px;
  padding:10px 18px;
  color:#f1c40f;
  border-radius:6px;
}
.submenu li a:hover {
  background:rgba(243,156,18,0.18);
  color:#fff;
  padding-left:28px;
}
@keyframes fadeIn {
  from { opacity:0; }
  to { opacity:1; }
}
@keyframes slideDown {
  from { transform:translateY(-10px); opacity:0; }
  to { transform:translateY(0); opacity:1; }
}
@media (max-width: 700px) {
  .sidebar {
    width: 100vw;
    border-radius:0;
    position:relative;
    height:auto;
  }
  .container, .topbar {
    margin-left:0;
  }
}

/* Topbar */
.topbar {
  margin-left:250px;
  background:#fff;
  color:#232526;
  padding:18px 30px 18px 30px;
  font-size:22px;
  font-weight:600;
  box-shadow:0 2px 8px rgba(0,0,0,0.08);
  display:flex;
  align-items:center;
  justify-content:space-between;
  position:sticky;
  top:0;
  z-index:10;
}
.topbar .profile {
  display:flex;
  align-items:center;
  gap:12px;
}
.topbar .profile-img {
  width:38px;
  height:38px;
  border-radius:50%;
  object-fit:cover;
  border:2px solid #f39c12;
}
.topbar .logout-btn {
  background:#e74c3c;
  color:#fff;
  border:none;
  padding:8px 18px;
  border-radius:5px;
  cursor:pointer;
  font-size:15px;
  margin-left:10px;
  transition:background 0.2s;
}
.topbar .logout-btn:hover {
  background:#c0392b;
}

/* Dashboard Content */
.container {
  margin-left:270px;
  padding:30px 20px 20px 20px;
}
.dashboard-title {
  font-size:28px;
  font-weight:700;
  color:#232526;
  margin-bottom:30px;
  letter-spacing:1px;
}
.card-container {
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
  gap:28px;
}
.card {
  background:linear-gradient(135deg,#6a11cb 0%,#2575fc 100%);
  color:#fff;
  padding:32px 24px 24px 24px;
  border-radius:16px;
  box-shadow:0 4px 18px rgba(80,80,180,0.13);
  position:relative;
  overflow:hidden;
  transition:transform 0.18s, box-shadow 0.18s;
  min-height:120px;
}
.card:hover {
  transform:translateY(-6px) scale(1.03);
  box-shadow:0 8px 32px rgba(80,80,180,0.18);
}
.card .icon {
  font-size:32px;
  position:absolute;
  top:18px;
  right:22px;
  opacity:0.18;
}
.card .count {
  font-size:32px;
  font-weight:700;
  margin-bottom:8px;
  color:#fff;
  text-shadow:0 2px 8px rgba(0,0,0,0.10);
}
.card h3 {
  margin:0;
  font-size:18px;
  font-weight:500;
  color:#fff;
  letter-spacing:0.5px;
}
@media (max-width: 900px) {
  .container {
    margin-left:0;
    padding:18px 6px 6px 6px;
  }
  .topbar {
    margin-left:0;
    padding:12px 10px;
    font-size:18px;
  }
}
</style>
</head>
<body>

<!-- Sidebar (imported) -->
<div class="sidebar">
  <div class="sidebar-header">
    <img src="../images/banner.jpg" alt="Logo" class="sidebar-logo">
    <h2>SARA DJ Admin</h2>
  </div>
  <ul>
    <li class="active"><a href="admin_dashboard.php"><i class="fa fa-home"></i>&nbsp; Dashboard</a></li>
    <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('djMenu')"><i class="fa fa-music"></i>&nbsp; DJ Services</a>
      <ul id="djMenu" class="submenu">
        <li><a href="add_service.php">➕ Add Service</a></li>
        <li><a href="manage_service.php">⚙️ Manage Services</a></li>
      </ul>
    </li>
    <!-- <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('eventMenu')"><i class="fa fa-calendar"></i>&nbsp; Type of Events</a>
      <ul id="eventMenu" class="submenu">
        <li><a href="add_event.php">➕ Add Event</a></li>
        <li><a href="manage_event.php">⚙️ Manage Events</a></li>
      </ul>
    </li> -->
    <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('bookingMenu')"><i class="fa fa-book"></i>&nbsp; Bookings</a>
      <ul id="bookingMenu" class="submenu">
        <li><a href="new_booking.php">🆕 New Bookings</a></li>
        <li><a href="approved_booking.php">✅ Approved Bookings</a></li>
        <li><a href="cancelled_booking.php">❌ Cancelled Bookings</a></li>
        <li><a href="all_booking.php">� All Bookings</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('queriesMenu')"><i class="fa fa-envelope"></i>&nbsp; Contact Queries</a>
      <ul id="queriesMenu" class="submenu">
        <li><a href="unread_queries.php">� Unread Queries</a></li>
        <li><a href="read_queries.php">� Read Queries</a></li>
      </ul>
    </li>
    <li><a href="bwdates_report.php"><i class="fa fa-chart-bar"></i>&nbsp; B/W Dates Report</a></li>
    <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('searchMenu')"><i class="fa fa-search"></i>&nbsp; Search</a>
      <ul id="searchMenu" class="submenu">
        <li><a href="user_search.php">� User Search</a></li>
        <li><a href="booking_search.php">� Booking Search</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('pagesMenu')"><i class="fa fa-file-alt"></i>&nbsp; Pages</a>
      <ul id="pagesMenu" class="submenu">
        <li><a href="page_about.php">ℹ️ About Us</a></li>
        <li><a href="page_contact.php">📞 Contact Us</a></li>
      </ul>
    </li>
    <!-- <li><a href="logout.php"><i class="fa fa-sign-out-alt"></i>&nbsp; Logout</a></li> -->
  </ul>
</div>

<!-- Topbar -->
<div class="topbar">
  <span>Welcome, Administrator</span>
  <div class="profile">
    <img src="../images/banner.jpg" alt="Profile" class="profile-img">
    <form action="logout.php" method="post" style="display:inline;">
      <button type="submit" class="logout-btn"><i class="fa fa-sign-out-alt"></i> Logout</button>
    </form>
  </div>
</div>

<!-- Dashboard Content -->
<div class="container">
  <div class="dashboard-title">Dashboard Overview</div>
  <div class="card-container">
    <div class="card">
      <div class="count">16</div>
      <h3>Total Unread Queries</h3>
      <div class="icon"><i class="fa fa-envelope"></i></div>
    </div>
    <div class="card">
      <div class="count">10</div>
      <h3>Total Read Queries</h3>
      <div class="icon"><i class="fa fa-envelope-open"></i></div>
    </div>
    <div class="card">
      <div class="count">6</div>
      <h3>Total New Booking</h3>
      <div class="icon"><i class="fa fa-calendar-plus"></i></div>
    </div>
    <div class="card">
      <div class="count">13</div>
      <h3>Total Approved Booking</h3>
      <div class="icon"><i class="fa fa-check-circle"></i></div>
    </div>
    <div class="card">
      <div class="count">6</div>
      <h3>Total Cancelled Booking</h3>
      <div class="icon"><i class="fa fa-times-circle"></i></div>
    </div>
    <div class="card">
      <div class="count">9</div>
      <h3>Total Services</h3>
      <div class="icon"><i class="fa fa-music"></i></div>
    </div>
    <!-- <div class="card">
      <div class="count">4</div>
      <h3>Total Event Type</h3>
      <div class="icon"><i class="fa fa-calendar"></i></div>
    </div> -->
  </div>
</div>

<script>
function toggleMenu(id) {
  var menu = document.getElementById(id);
  var parent = menu.parentElement;
  if (parent.classList.contains('open')) {
    parent.classList.remove('open');
  } else {
    // Close other open dropdowns
    var dropdowns = document.querySelectorAll('.sidebar .dropdown');
    dropdowns.forEach(function(dd) {
      dd.classList.remove('open');
    });
    parent.classList.add('open');
  }
}
</script>

</body>
</html>
