<div class="sidebar">
  <div class="sidebar-header">
    <img src="../images/banner.jpg" alt="Logo" class="sidebar-logo">
    <h2>SARA DJ Admin</h2>
  </div>
  <ul>
    <li><a href="admin_dashboard.php">🏠 Dashboard</a></li>
    
    <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('djMenu')">🎵 DJ Services ▾</a>
      <ul id="djMenu" class="submenu">
        <li><a href="add_service.php">➕ Add Service</a></li>
        <li><a href="manage_service.php">⚙️ Manage Services</a></li>
      </ul>
    </li>

    <!-- <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('eventMenu')">🎉 Type of Events ▾</a>
      <ul id="eventMenu" class="submenu">
        <li><a href="add_event.php">➕ Add Event</a></li>
        <li><a href="manage_event.php">⚙️ Manage Events</a></li>
      </ul>
    </li> -->

    <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('bookingMenu')">📅 Bookings ▾</a>
      <ul id="bookingMenu" class="submenu">
        <li><a href="new_booking.php">🆕 New Bookings</a></li>
        <li><a href="approved_booking.php">✅ Approved Bookings</a></li>
        <li><a href="cancelled_booking.php">❌ Cancelled Bookings</a></li>
        <li><a href="all_booking.php">📋 All Bookings</a></li>
      </ul>
    </li>

    <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('queriesMenu')">📨 Contact Queries ▾</a>
      <ul id="queriesMenu" class="submenu">
        <li><a href="unread_queries.php">📩 Unread Queries</a></li>
        <li><a href="read_queries.php">📖 Read Queries</a></li>
      </ul>
    </li>

    <li><a href="bwdates_report.php">📊 B/W Dates Report</a></li>

    <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('searchMenu')">🔍 Search ▾</a>
      <ul id="searchMenu" class="submenu">
        <li><a href="user_search.php">👤 User Search</a></li>
        <!-- <li><a href="booking_search.php">📅 Booking Search</a></li> -->
      </ul>
    </li>

    <!-- <li class="dropdown">
      <a href="javascript:void(0)" onclick="toggleMenu('pagesMenu')">📄 Pages ▾</a>
      <ul id="pagesMenu" class="submenu">
        <li><a href="page_about.php">ℹ️ About Us</a></li>
        <li><a href="page_contact.php">📞 Contact Us</a></li>
      </ul>
    </li> -->

    <!-- <li><a href="logout.php">🚪 Logout</a></li> -->
  </ul>
</div>


<style>
body {
  margin:0;
  font-family:'Segoe UI', Arial, sans-serif;
  background:#f5f6fa;
}

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

.topbar {
  margin-left:250px;
  background:#34495e;
  color:#fff;
  padding:15px;
  font-size:20px;
  font-weight:bold;
  box-shadow:0 2px 6px rgba(0,0,0,0.2);
}

.container {
  margin-left:270px;
  padding:20px;
}
</style>

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
