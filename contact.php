<!DOCTYPE html>
<html>
<head>
    <title>Contact Us - SARA DJ Booking</title>
    <style>
        html, body { height: 100%; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin:0; 
            padding:0; 
            /* full page background image */
            background-image: url('images/contact.jpg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
            color:#fff;
        }

        /* dark overlay so content stays readable */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            pointer-events: none;
            z-index: 1;
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

        /* Navigation */
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

        /* Contact Container */
        .contact-container {
            max-width: 700px;
            margin: 40px auto;
            background: linear-gradient(135deg, #fdf6f0, #ffe5d4);
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            z-index: 2; /* sit above overlay */
        }
        .contact-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }
        .contact-container h2 {
            color: #d35400;
            margin-bottom: 20px;
            font-size: 28px;
        }
        .contact-container p {
            font-size: 18px;
            margin: 12px 0;
            line-height: 1.5;
        }
        .contact-container b {
            color: #2c3e50;
        }

        /* Contact Form */
        .form-container {
            margin-top: 30px;
            text-align: left;
        }
        .form-container label {
            font-weight: bold;
            display: block;
            margin: 8px 0 5px;
            color: #2c3e50;
        }
        .form-container input, 
        .form-container textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }
        .form-container button {
            padding: 12px;
            background:#2c3e50;
            color:#fff;
            border:none;
            border-radius:6px;
            font-size:18px;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
        }
        .form-container button:hover {
            background:#f39c12;
        }

        /* Map */
        .map-container {
            margin-top: 30px;
        }
        .map-container iframe {
            width: 100%;
            height: 300px;
            border: none;
            border-radius: 10px;
        }

        /* Footer */
        footer { 
            background: linear-gradient(90deg, #2c3e50, #34495e); 
            color:#fff; 
            padding:20px; 
            text-align:center; 
            margin-top:30px; 
            font-size:14px;
        }
        footer a { 
            color:#f39c12; 
            text-decoration:none; 
            margin:0 8px;
        }
        footer a:hover {
            text-decoration:underline;
        }
    </style>
    <style>
        /* Mobile: disable fixed background for smoother scrolling */
        @media (max-width: 768px) {
            body { background-attachment: scroll; }
        }
    </style>
</head>
<body>
<header>
    <h1 class="header1">Contact Us</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="services.php">DJ Services</a>
        <a href="request_status.php">Request Status</a>
        <a href="contact.php">Contact</a>
        <a href="admin_login.php">Admin Login</a>
    </nav>
</header>

<div class="contact-container">
    <h2>SARA DJ Booking Contact</h2>
   
    <p><b>Phone:</b> <span style="color:#000;">+91 9894624715</span></p>
    <p><b>Email:</b> <span style="color:#000;">saradj@gmail.com</span></p>
    <p><b>Address:</b> <span style="color:#000;">Pagandai Kootu Road, Vanapuram(TK), Kallakurichi (DT).</span></p>

    <!-- Contact Form -->
    <div class="form-container" style="background: linear-gradient(rgba(255,255,255,0.85), rgba(255,245,235,0.85)), url('images/2.jpg'); background-size: cover; background-position: center; padding:20px; border-radius:10px;">
        <form action="send_message.php" method="post">
            <label for="name">Your Name</label>
            <input type="text" name="name" id="name" placeholder="Enter Your Name" required>

            <label for="email">Your Email</label>
            <input type="email" name="email" id="email" placeholder="Enter Your email" required>

            <label for="message">Your Message</label>
            <textarea name="message" id="message" rows="5" placeholder="Enter Your Message" required></textarea>

            <button type="submit" style="display:block; margin:20px auto; padding:12px 30px; background:#2c3e50; color:#fff; border:none; border-radius:6px; font-size:18px; font-weight:bold; cursor:pointer; transition:0.3s;">
    Send Message
</button>
        </form>
    </div>

    <!-- Google Map Embed -->
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3910.123456!2d79.123456!3d11.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3xxxx%3A0x4xxxx!2sVanapuram!5e0!3m2!1sen!2sin!4v000000000"
            allowfullscreen>
        </iframe>
    </div>
</div>

<footer>
    <p>&copy; 2025 SARA DJ Booking. All Rights Reserved.</p>
</footer>
</body>
</html>
