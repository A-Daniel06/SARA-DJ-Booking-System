<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SARA DJ Services</title>
  <style>
    html, body { height: 100%; }
    body {
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
  /* Background image: cover and fixed for full-screen effect */
  background-image: url('images/services2.jpg');
      background-repeat: no-repeat;
      background-position: center center;
      /* Explicit width and height for the background image (change values as needed) */
      background-size: 1500px 900px;
      background-attachment: fixed;
      color: #fff;
    }

    /* Slight dark overlay to keep text readable over the image */
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.45);
      pointer-events: none;
      z-index: 1;
    }

    /* Responsive: use cover on smaller screens so image scales nicely */
    @media (max-width: 1200px) {
      body { background-size: cover; }
    }

    /* Header */
   header { 
    background: linear-gradient(90deg, #2c3e50, #34495e); 
    color:#fff; 
    padding:20px 0; 
    text-align:right; 
    box-shadow:0 3px 6px rgba(0,0,0,0.2);
}
.header1 { 
    background: linear-gradient(90deg, #2c3e50, #34495e); 
    color:#fff; 
    padding:20px 0; 
    text-align:center; 
    box-shadow:0 3px 6px rgba(0,0,0,0.2);
    
}
header h1 { margin:0; font-size:38px; letter-spacing:1px; }
   nav { margin-top:20px; }
nav a { 
    display:inline-block;
    vertical-align:middle;
    color:#fff; 
    margin:0 15px; 
    text-decoration:none; 
    font-weight:bold; 
    transition:0.3s;
    font-size:18px;
}
nav a:hover { 
    color:#f39c12; 
    text-decoration:underline; 
}

    /* Services container */
    .services-container {
      max-width: 1000px;
      margin: 50px auto;
      background: rgba(0,0,0,0.6);
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.4);
      position: relative;
      z-index: 2; /* place above the page overlay */
    }

    .services-container h2 {
      font-size: 36px;
      margin-bottom: 20px;
      text-align: center;
      border-bottom: 3px solid #f39c12;
      padding-bottom: 10px;
      color: #f39c12;
    }

    /* Service rows */
    .service-row {
      display: grid;
      grid-template-columns: 1.2fr 2fr 1fr 1fr;
      align-items: center;
      padding: 20px 0;
      border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    .service-row:last-child { border-bottom: none; }

    .service-title {
      font-weight: bold;
      font-size: 20px;
      color: #e91e63;
    }
    .service-desc { font-size: 15px; color: #ddd; }
    .service-price { font-size: 18px; font-weight: bold; color: #fff; }

    /* Buttons */
    .book-btn {
      background: transparent;
      border: 2px solid #e91e63;
      color: #e91e63;
      padding: 8px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
      text-align: center;
      display: inline-block;
    }
    .book-btn:hover {
      background: #e91e63;
      color: #fff;
      transform: scale(1.05);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .service-row {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 10px;
      }
    }

    /* Footer */
    footer { 
      background: linear-gradient(90deg, #2c3e50, #34495e); 
      color:#fff; 
      padding:20px; 
      text-align:center; 
      margin-top:30px; 
      font-size:14px;
      position: relative;
      z-index: 2;
    }
    footer a { 
      color:#f39c12; 
      text-decoration:none; 
      margin:0 8px;
    }
    footer a:hover { text-decoration:underline; }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <h1 class="header1">DJ Services</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="about.php">About</a>
      <a href="services.php">DJ Services</a>
      <a href="request_status.php">Request Status</a>
      <a href="contact.php">Contact</a>
      <a href="admin_login.php">Admin Login</a>
    </nav>
  </header>

  <!-- Services Section -->
    <div class="services-container">
    <h2 style="color: #00e6e6; text-shadow: 1px 1px 8px #222; font-size: 44px;">Our Services</h2>

    <!-- Static header row -->
    <div class="service-row" style="background:rgba(0,0,0,0.18);border-radius:8px;font-size:22px;font-weight:bold;text-transform:uppercase;letter-spacing:1px;">
      <div class="service-title" style="color:#fff;font-size:22px;">Services</div>
      <div class="service-desc" style="color:#fff;font-size:22px;">Description</div>
      <div class="service-price" style="color:#fff;font-size:22px;">Price</div>
      <div style="color:#fff;font-size:22px;text-align:center;">Book DJ</div>
    </div>

    <?php
    $json_file = __DIR__ . '/services_data.json';
    $services = [];
    if (file_exists($json_file)) {
        $services = json_decode(file_get_contents($json_file), true) ?: [];
    }
    if (!empty($services)):
      foreach ($services as $service):
    ?>
    <div class="service-row" style="background: rgba(0, 230, 230, 0.08); border-radius: 8px; font-size: 22px;">
      <div class="service-title" style="color: #00e6e6; font-size: 26px;">
        <?php echo htmlspecialchars($service['service_name']); ?>
      </div>
      <div class="service-desc" style="color: #b2fefa; font-size: 18px;">
        <?php echo htmlspecialchars($service['description']); ?>
      </div>
      <div class="service-price" style="color: #fff176; font-size: 22px;">
        ₹ <?php echo htmlspecialchars($service['price']); ?>
      </div>
      <a href="book_service.php?service=<?php echo urlencode($service['service_name']); ?>" class="book-btn" style="border-color: #00e6e6; color: #00e6e6; font-size: 18px;">Book Services</a>
    </div>
    <?php endforeach; else: ?>
    <div style="color:#fff;text-align:center;font-size:20px;margin:40px 0;">No services available.</div>
    <?php endif; ?>

    <!-- <div class="service-row" style="background: rgba(233, 30, 99, 0.08); border-radius: 8px; font-size: 22px;">
      <div class="service-title" style="color: #e91e63; font-size: 26px;">Ceremony Music</div>
      <div class="service-desc" style="color: #f8bbd0; font-size: 18px;">Our ceremony music service is a popular add-on to our wedding DJ full-day hire.</div>
      <div class="service-price" style="color: #ff7043; font-size: 22px;">₹ 50,000</div>
      <a href="book_service.php?service=Ceremony Music" class="book-btn" style="border-color: #e91e63; color: #e91e63; font-size: 18px;">Book Services</a>
    </div>

    <div class="service-row" style="background: rgba(76, 175, 80, 0.08); border-radius: 8px; font-size: 22px;">
      <div class="service-title" style="color: #4caf50; font-size: 26px;">Photo Booth Hire</div>
      <div class="service-desc" style="color: #b9f6ca; font-size: 18px;">(Early equipment setup included)</div>
      <div class="service-price" style="color: #ffd54f; font-size: 22px;">₹ 40,000</div>
      <a href="book_service.php?service=Photo Booth Hire" class="book-btn" style="border-color: #4caf50; color: #4caf50; font-size: 18px;">Book Services</a>
    </div>

    <div class="service-row" style="background: rgba(156, 39, 176, 0.08); border-radius: 8px; font-size: 22px;">
      <div class="service-title" style="color: #9c27b0; font-size: 26px;">Karaoke Add-on</div>
      <div class="service-desc" style="color: #e1bee7; font-size: 18px;">Karaoke is a great alternative to a disco. Perfect for staff parties & children’s events.</div>
      <div class="service-price" style="color: #00bcd4; font-size: 22px;">₹ 35,000</div>
      <a href="book_service.php?service=Karaoke Add-on" class="book-btn" style="border-color: #9c27b0; color: #9c27b0; font-size: 18px;">Book Services</a>
    </div>

    <div class="service-row" style="background: rgba(255, 87, 34, 0.08); border-radius: 8px; font-size: 22px;">
      <div class="service-title" style="color: #ff5722; font-size: 26px;">Uplighters</div>
      <div class="service-desc" style="color: #ffccbc; font-size: 18px;">Bright lighting fixtures installed on the floor to create a vibrant wash of color.</div>
      <div class="service-price" style="color: #00e6e6; font-size: 22px;">₹ 15,000</div>
      <a href="book_service.php?service=Uplighters" class="book-btn" style="border-color: #ff5722; color: #ff5722; font-size: 18px;">Book Services</a>
    </div>
    </div> -->

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 SARA DJ Booking. All Rights Reserved. | 
      <a href="privacy.php">Privacy Policy</a> | 
      <a href="terms.php">Terms & Conditions</a>
    </p>
  </footer>

</body>
</html>
