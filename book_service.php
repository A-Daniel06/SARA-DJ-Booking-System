<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
  try {
    $name = $_POST['name'];
    $mobnum = $_POST['mobnum'];
    $email = $_POST['email'];
    $edate = $_POST['edate'];
    $est = $_POST['est'];
    $eetime = $_POST['eetime'];
    $vaddress = $_POST['vaddress'];
    $service_name = $_POST['service_name'];
    $addinfo = isset($_POST['addinfo']) ? $_POST['addinfo'] : '';
    $bookingid = mt_rand(100000000, 999999999);

    // Always set EventType to 'Pending' for new bookings
    $sql = "INSERT INTO tblbooking(BookingID,ServiceID,Name,MobileNumber,Email,EventDate,EventStartingtime,EventEndingtime,VenueAddress,EventType,AdditionalInformation) 
        VALUES(:bookingid,:service_name,:name,:mobnum,:email,:edate,:est,:eetime,:vaddress,:eventtype,:addinfo)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);
    $query->bindParam(':service_name', $service_name, PDO::PARAM_STR);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':mobnum', $mobnum, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':edate', $edate, PDO::PARAM_STR);
    $query->bindParam(':est', $est, PDO::PARAM_STR);
    $query->bindParam(':eetime', $eetime, PDO::PARAM_STR);
    $query->bindParam(':vaddress', $vaddress, PDO::PARAM_STR);
    $eventtype = 'Pending';
    $query->bindParam(':eventtype', $eventtype, PDO::PARAM_STR);
    $query->bindParam(':addinfo', $addinfo, PDO::PARAM_STR);

    $query->execute();
    $LastInsertId = $dbh->lastInsertId();
    if ($LastInsertId > 0) {
      echo '<script>alert("Your Booking Request Has Been Sent. We Will Contact You Soon")</script>';
      echo "<script>window.location.href ='services.php'</script>";
    } else {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
  } catch (PDOException $e) {
    echo '<script>alert("Database Error: ' . addslashes($e->getMessage()) . '")</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Service - SARA DJ Booking</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
      background: url('images/services-bg.jpg') no-repeat center center/cover;
      color: #333;
    }

    /* Header */
    header { 
      background: linear-gradient(90deg, #2c3e50, #34495e); 
      color:#fff; 
      padding:20px 0; 
      text-align:right; 
      box-shadow:0 3px 6px rgba(0,0,0,0.2);
    }
    header h1 { 
      margin:0; 
      font-size:32px; 
      text-align:center; 
      letter-spacing:1px; 
    }
    nav { margin-top:15px; text-align:right; padding-right:20px; }
    nav a { 
      display:inline-block;
      color:#fff; 
      margin:0 12px; 
      text-decoration:none; 
      font-weight:bold; 
      transition:0.3s;
      font-size:16px;
    }
    nav a:hover { 
      color:#f39c12; 
      text-decoration:underline; 
    }

    /* Booking Form */
    .container {
      max-width: 650px;
      margin: 40px auto;
      padding: 35px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.15);
      animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity:0; transform: translateY(20px); }
      to { opacity:1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 25px;
      font-size: 28px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    label {
      font-weight: bold;
      color: #2c3e50;
      margin-bottom: 5px;
      font-size: 15px;
    }

    input, select, textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 15px;
      transition: all 0.3s ease;
    }

    input:focus, select:focus, textarea:focus {
      border-color: #2c3e50;
      outline: none;
      box-shadow: 0 0 8px rgba(44,62,80,0.3);
    }

    textarea {
      resize: vertical;
    }

    /* Book DJ Button */
    .book-btn {
      padding: 14px;
      background: linear-gradient(90deg, #2c3e50, #34495e);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .book-btn:hover {
      background: linear-gradient(90deg, #f39c12, #e67e22);
      transform: scale(1.05);
      box-shadow: 0 5px 15px rgba(243,156,18,0.4);
    }

    /* Footer */
    footer {
      background: linear-gradient(90deg, #2c3e50, #34495e);
      color: #fff;
      text-align: center;
      padding: 15px;
      margin-top: 40px;
    }
    footer a {
      color: #f39c12;
      margin: 0 8px;
      text-decoration: none;
    }
    footer a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<header>
  <h1>SARA DJ Booking System</h1>
  <nav>
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="services.php">DJ Services</a>
    <a href="request_status.php">Request Status</a>
    <a href="contact.php">Contact</a>
    <a href="admin_login.php">Admin Login</a>
  </nav>
</header>

<div class="container">
  <h2>Book Your Event</h2>
  <form method="post">
    <label>Name</label>
    <input type="text" name="name" placeholder="Enter Your Name" required>

    <label>Email</label>
    <input type="email" name="email" placeholder="Enter Your Email" required>

    <label>Mobile Number</label>
    <input type="text" name="mobnum" maxlength="10" pattern="[0-9]+" placeholder="Enter Your Mobile Number" required>

    <label>Event Date</label>
    <input type="date" name="edate" required>

    <label>Event Start Time</label>
    <select name="est" required>
      <option value="">Select Starting Time</option>
      <option value="1 a.m">1 a.m</option>
      <option value="2 a.m">2 a.m</option>
      <option value="3 a.m">3 a.m</option>
      <option value="4 a.m">4 a.m</option>
      <option value="5 a.m">5 a.m</option>
      <option value="6 a.m">6 a.m</option>
      <option value="7 a.m">7 a.m</option>
      <option value="8 a.m">8 a.m</option>
      <option value="9 a.m">9 a.m</option>
      <option value="10 a.m">10 a.m</option>
      <option value="11 a.m">11 a.m</option>
      <option value="12 p.m">12 p.m</option>
      <option value="1 p.m">1 p.m</option>
      <option value="2 p.m">2 p.m</option>
      <option value="3 p.m">3 p.m</option>
      <option value="4 p.m">4 p.m</option>
      <option value="5 p.m">5 p.m</option>
      <option value="6 p.m">6 p.m</option>
      <option value="7 p.m">7 p.m</option>
      <option value="8 p.m">8 p.m</option>
      <option value="9 p.m">9 p.m</option>
      <option value="10 p.m">10 p.m</option>
      <option value="11 p.m">11 p.m</option>
      <option value="12 p.m">12 p.m</option>
    </select>

    <label>Event Finish Time</label>
    <select name="eetime" required>
      <option value="">Select Finish Time</option>
      <option value="1 a.m">1 a.m</option>
      <option value="2 a.m">2 a.m</option>
      <option value="3 a.m">3 a.m</option>
      <option value="4 a.m">4 a.m</option>
      <option value="5 a.m">5 a.m</option>
      <option value="6 a.m">6 a.m</option>
      <option value="7 a.m">7 a.m</option>
      <option value="8 a.m">8 a.m</option>
      <option value="9 a.m">9 a.m</option>
      <option value="10 a.m">10 a.m</option>
      <option value="11 a.m">11 a.m</option>
      <option value="12 p.m">12 p.m</option>
      <option value="1 p.m">1 p.m</option>
      <option value="2 p.m">2 p.m</option>
      <option value="3 p.m">3 p.m</option>
      <option value="4 p.m">4 p.m</option>
      <option value="5 p.m">5 p.m</option>
      <option value="6 p.m">6 p.m</option>
      <option value="7 p.m">7 p.m</option>
      <option value="8 p.m">8 p.m</option>
      <option value="9 p.m">9 p.m</option>
      <option value="10 p.m">10 p.m</option>
      <option value="11 p.m">11 p.m</option>
      <option value="12 p.m">12 p.m</option>
    </select>

    <label>Venue Address</label>
    <textarea name="vaddress" id="vaddress" placeholder="Click 'Use my location' to fill exact address (you can edit)" required></textarea>
    <div style="margin-top:8px;">
      <button type="button" id="locBtn" style="padding:8px 12px; margin-right:8px;">Use my location</button>
      <button type="button" id="clearBtn" style="padding:8px 12px; margin-right:8px;">Clear</button>
      <button type="button" id="toggleMapBtn" style="padding:8px 12px;">Show map</button>
    </div>
    <input type="hidden" name="vlat" id="vlat">
    <input type="hidden" name="vlon" id="vlon">

    <!-- Leaflet CSS/JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="" crossorigin=""></script>

    <style>
      #mapContainer { margin-top:10px; display:none; }
      #map { width:100%; height:320px; border-radius:8px; border:1px solid #ddd; }
      .leaflet-control-attribution { display:none !important; } /* optional to hide attribution in small forms */
    </style>

    <div id="mapContainer">
      <div id="map"></div>
      <small style="color:#666;">Click map or drag marker to adjust exact location. Address updates automatically.</small>
    </div>

    <script>
      (function(){
      const locBtn = document.getElementById('locBtn');
      const clearBtn = document.getElementById('clearBtn');
      const toggleMapBtn = document.getElementById('toggleMapBtn');
      const addrField = document.getElementById('vaddress');
      const latField = document.getElementById('vlat');
      const lonField = document.getElementById('vlon');
      const mapContainer = document.getElementById('mapContainer');

      // initialize map
      const defaultCenter = [20.0, 0.0];
      const map = L.map('map', { center: defaultCenter, zoom: 2, zoomControl: true });
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
      }).addTo(map);

      let marker = null;

      function addOrMoveMarker(lat, lon, draggable = true) {
        if (marker) {
        marker.setLatLng([lat, lon]);
        } else {
        marker = L.marker([lat, lon], { draggable: draggable }).addTo(map);
        marker.on('dragend', onMarkerChanged);
        }
        if (draggable) marker.dragging.enable();
        latField.value = lat;
        lonField.value = lon;
      }

      function removeMarker() {
        if (marker) {
        map.removeLayer(marker);
        marker = null;
        }
      }

      async function reverseGeocode(lat, lon) {
        try {
        const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${encodeURIComponent(lat)}&lon=${encodeURIComponent(lon)}`, {
          headers: { 'Accept': 'application/json' }
        });
        if (!res.ok) throw new Error('Reverse geocode failed');
        const data = await res.json();
        return data.display_name || `${lat}, ${lon}`;
        } catch (e) {
        return `${lat}, ${lon}`;
        }
      }

      async function onMarkerChanged() {
        const pos = marker.getLatLng();
        latField.value = pos.lat;
        lonField.value = pos.lng;
        addrField.value = 'Detecting address...';
        const display = await reverseGeocode(pos.lat, pos.lng);
        addrField.value = display;
      }

      // place/move marker on map click
      map.on('click', async (e) => {
        const { lat, lng } = e.latlng;
        addOrMoveMarker(lat, lng, true);
        map.setView([lat, lng], Math.max(map.getZoom(), 15));
        addrField.value = 'Detecting address...';
        addrField.value = await reverseGeocode(lat, lng);
      });

      locBtn.addEventListener('click', () => {
        if (!navigator.geolocation) {
        alert('Geolocation is not supported by your browser.');
        return;
        }
        locBtn.disabled = true;
        locBtn.textContent = 'Detecting...';
        navigator.geolocation.getCurrentPosition(async (pos) => {
        const lat = pos.coords.latitude;
        const lon = pos.coords.longitude;
        latField.value = lat;
        lonField.value = lon;
        mapContainer.style.display = 'block';
        toggleMapBtn.textContent = 'Hide map';
        map.invalidateSize();
        map.setView([lat, lon], 17);
        addOrMoveMarker(lat, lon, true);
        addrField.value = 'Detecting address...';
        addrField.value = await reverseGeocode(lat, lon);
        locBtn.disabled = false;
        locBtn.textContent = 'Use my location';
        }, (err) => {
        locBtn.disabled = false;
        locBtn.textContent = 'Use my location';
        switch(err.code) {
          case err.PERMISSION_DENIED: alert('Permission denied. Allow location access to use this feature.'); break;
          case err.POSITION_UNAVAILABLE: alert('Position unavailable.'); break;
          case err.TIMEOUT: alert('Location request timed out.'); break;
          default: alert('Unable to retrieve location.'); break;
        }
        }, { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 });
      });

      clearBtn.addEventListener('click', () => {
        addrField.value = '';
        latField.value = '';
        lonField.value = '';
        removeMarker();
        map.setView(defaultCenter, 2);
        addrField.focus();
      });

      toggleMapBtn.addEventListener('click', () => {
        if (mapContainer.style.display === 'none' || mapContainer.style.display === '') {
        mapContainer.style.display = 'block';
        toggleMapBtn.textContent = 'Hide map';
        setTimeout(() => map.invalidateSize(), 200);
        } else {
        mapContainer.style.display = 'none';
        toggleMapBtn.textContent = 'Show map';
        }
      });

      // If the user edits lat/lon programmatically or server fills them, show marker
      (function initFromFields(){
        const lat = parseFloat(latField.value || '');
        const lon = parseFloat(lonField.value || '');
        if (!isNaN(lat) && !isNaN(lon)) {
        mapContainer.style.display = 'block';
        toggleMapBtn.textContent = 'Hide map';
        map.invalidateSize();
        map.setView([lat, lon], 15);
        addOrMoveMarker(lat, lon, true);
        }
      })();
      })();
    </script>
    

    <label>Choose Service</label>
    <select name="service_name" id="serviceSelect" required>
      <option value="">Choose Service</option>
      <?php
        $json_file = __DIR__ . '/services_data.json';
        $services = [];
        if (file_exists($json_file)) {
          $services = json_decode(file_get_contents($json_file), true) ?: [];
        }
        foreach ($services as $service) {
          echo '<option value="'.htmlspecialchars($service['service_name']).'">'.htmlspecialchars($service['service_name']).' (₹'.htmlspecialchars($service['price']).')</option>';
        }
      ?>
    </select>

    <button type="submit" class="book-btn" name="submit">BOOK DJ</button>
  </form>
</div>

<footer>
  <p>&copy; 2025 SARA DJ Booking. All Rights Reserved.</p>
  <p><a href="#">Privacy Policy</a> | <a href="#">Terms</a></p>
</footer>

</body>
</html>
