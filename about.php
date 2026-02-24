
<!DOCTYPE html>
<html>
<head>
    <title>About Us - SARA DJ Booking</title>
    <style>
        body {
    font-family: 'Segoe UI', Arial, sans-serif;
    margin:0; 
    padding:0; 
    background:#f3f3f3; 
    color:#333;
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

/* Sections */
.section, .section1 { 
    margin:30px auto; 
    max-width:1100px;
    border-radius:12px; 
    box-shadow:0 4px 8px rgba(0,0,0,0.1);
    width:90%; 
    padding:30px;
    background:#fff;
    color:#333;
}
.section h2, .section1 h2 { 
    text-align:center; 
    margin-bottom:20px; 
    color:#2c3e50; 
    font-size:28px;
}

/* Services */
.services { 
    display:flex; 
    justify-content:space-around; 
    flex-wrap:wrap;
    gap:20px;
}
.service-box { 
    width:30%; 
    min-width:280px;
    background:#fdfdfd; 
    padding:25px; 
    border-radius:12px; 
    text-align:center; 
    box-shadow:0 3px 8px rgba(0,0,0,0.1); 
    transition:0.3s;
}
.service-box:hover {
    transform:translateY(-8px);
    box-shadow:0 6px 15px rgba(0,0,0,0.2);
}
.service-box h3 { 
    color:#2c3e50; 
    margin-bottom:10px; 
}
.service-box p { 
    font-size:16px; 
    color:#666; 
}
.service-box a {
    display:inline-block;
    margin-top:15px;
    padding:10px 20px;
    background:#2c3e50;
    color:#fff;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}
.service-box a:hover {
    background:#f39c12;
}

/* Forms (for login, request status, contact) */
.form-container {
    max-width:500px;
    margin:30px auto;
    padding:30px;
    background:#fff;
    border-radius:12px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}
.form-container h2 {
    text-align:center;
    margin-bottom:20px;
    color:#2c3e50;
}
.form-container input, 
.form-container textarea, 
.form-container select {
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:16px;
}
.form-container button {
    width:100%;
    padding:12px;
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
</head>
<body>
<header>
    <h1 class="header1">About SARA DJ </h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="services.php">DJ Services</a>
        <a href="request_status.php">Request Status</a>
        <a href="contact.php">Contact</a>
        <a href="admin_login.php">Admin Login</a>
    </nav>
</header>

<!-- Banner -->
<center>
<div class="banner">
    <h2>About SARA DJ Services</h2>
    <p>Music that moves your soul, beats that light up your event.</p>
</div>
<style>
.banner {
    background: linear-gradient(90deg, #f39c12 0%, #e67e22 100%);
    color: #fff;
    padding: 40px 20px 30px 20px;
    border-radius: 16px;
    margin: 30px auto 20px auto;
    max-width: 800px;
    box-shadow: 0 6px 18px rgba(44, 62, 80, 0.15);
    text-align: center;
    position: relative;
    overflow: hidden;
}
.banner h2 {
    font-size: 36px;
    margin-bottom: 12px;
    letter-spacing: 1px;
    font-weight: bold;
    text-shadow: 0 2px 8px rgba(44,62,80,0.12);
}
.banner p {
    font-size: 20px;
    margin: 0;
    font-style: italic;
    letter-spacing: 0.5px;
    text-shadow: 0 1px 4px rgba(44,62,80,0.10);
}
@media (max-width: 600px) {
    .banner {
        padding: 25px 10px 18px 10px;
        max-width: 98%;
    }
    .banner h2 {
        font-size: 24px;
    }
    .banner p {
        font-size: 15px;
    }
}
</style>
</center>
<!-- About Content -->
<div class="section enhanced-about">
    <h2>Who We Are</h2>
    <p class="about-intro">
        <img src="images/about.jpg" alt="SARA DJ performing" style="float:right; margin:0 0 12px 18px; width:260px; max-width:40%; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.12);">
        SARA DJ Booking Service is one of the most trusted DJ providers in India. 
        We specialize in offering professional DJs for weddings, birthdays, corporate events, 
        and special occasions. Our DJs are known for their energy, creativity, and ability 
        to keep the crowd dancing all night long. With years of experience, 
        top-notch equipment, and customized playlists, we ensure your event is unforgettable.
    </p>

    <div class="mv-container">
        <div class="mv-box">
            <h3>🎯 Our Mission</h3>
            <p>To deliver exceptional DJ experiences that create lasting memories for our clients 
            while ensuring professionalism and reliability at every event.</p>
        </div>
        <div class="mv-box">
            <h3>🌟 Our Vision</h3>
            <p>To become the leading DJ booking service provider in India, known for innovation, 
            customer satisfaction, and top-quality entertainment.</p>
        </div>
    </div>
</div>
<style>
/* Enhanced About Section Styles */
.enhanced-about {
    background: linear-gradient(120deg, #f8fafc 60%, #fef6e4 100%);
    border: 2px solid #f39c12;
    box-shadow: 0 8px 32px rgba(44,62,80,0.10);
    padding-top: 40px;
    padding-bottom: 40px;
    position: relative;
    overflow: hidden;
}
.about-intro {
    font-size: 18px;
    color: #444;
    line-height: 1.7;
    margin-bottom: 32px;
    background: rgba(255,255,255,0.7);
    border-left: 4px solid #f39c12;
    padding: 18px 22px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(243,156,18,0.07);
}
.enhanced-about h2 {
    font-size: 32px;
    color: #e67e22;
    letter-spacing: 1.5px;
    margin-bottom: 18px;
    text-shadow: 0 2px 8px rgba(243,156,18,0.10);
}
@media (max-width: 700px) {
    .enhanced-about {
        padding: 18px 6px;
    }
    .about-intro {
        font-size: 15px;
        padding: 10px 8px;
    }
    .enhanced-about h2 {
        font-size: 22px;
    }
}
</style>
<style>
.mv-container {
    display: flex;
    justify-content: center;
    gap: 32px;
    margin-top: 32px;
    flex-wrap: wrap;
}
.mv-box {
    background: linear-gradient(120deg, #f9e79f 0%, #fad7a0 100%);
    border-radius: 14px;
    box-shadow: 0 4px 16px rgba(44,62,80,0.10);
    padding: 28px 32px;
    min-width: 260px;
    max-width: 400px;
    flex: 1 1 300px;
    margin: 10px;
    text-align: center;
    transition: transform 0.2s, box-shadow 0.2s;
}
.mv-box:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 8px 24px rgba(243,156,18,0.18);
}
.mv-box h3 {
    color: #e67e22;
    margin-bottom: 12px;
    font-size: 22px;
    letter-spacing: 0.5px;
}
.mv-box p {
    color: #555;
    font-size: 16px;
    margin: 0;
}
@media (max-width: 900px) {
    .mv-container {
        flex-direction: column;
        align-items: center;
        gap: 18px;
    }
    .mv-box {
        max-width: 95%;
        padding: 22px 12px;
    }
}
</style>

<footer>
    <p>&copy; 2025 SARA DJ Booking. All Rights Reserved.</p>
    <p><a href="#">Privacy Policy</a> | <a href="#">Terms</a></p>
</footer>
</body>
</html>
