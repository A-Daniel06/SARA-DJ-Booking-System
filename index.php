<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="responsive.css">
    <title>Home - SARA DJ Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin:0; 
            padding:0; 
            color:#333;
            /* plain white background */
            background-color: #ffffff;
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
            /* Why Choose SARA DJ Section */
            .why-section {
                background: linear-gradient(120deg, #f3e8ff 0%, #e0f7fa 100%);
                box-shadow: 0 6px 24px rgba(124,58,237,0.10);
                border-radius: 22px;
                padding: 56px 48px 48px 48px;
                margin: 48px auto 38px auto;
                max-width: 950px;
                text-align: center;
                position: relative;
                border: 2.5px solid #7c3aed;
            }
            .why-section h2 {
                color: #7c3aed;
                font-size: 2.5rem;
                font-weight: 800;
                margin-bottom: 18px;
                letter-spacing: 1px;
            }
            .why-desc {
                color: #333;
                font-size: 1.35rem;
                margin: 0 auto 32px auto;
                max-width: 700px;
                font-weight: 500;
            }
            .why-list {
                list-style: none;
                padding: 0;
                margin: 0 auto;
                max-width: 600px;
                display: flex;
                flex-direction: column;
                gap: 28px;
            }
            .why-list li {
                font-size: 1.22rem;
                color: #444;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(124,58,237,0.07);
                padding: 18px 24px 18px 60px;
                text-align: left;
                position: relative;
                font-weight: 600;
                transition: box-shadow 0.2s, transform 0.2s;
            }
            .why-list li:hover {
                box-shadow: 0 6px 18px rgba(124,58,237,0.13);
                transform: translateY(-3px) scale(1.03);
            }
            .why-icon {
                position: absolute;
                left: 18px;
                top: 50%;
                transform: translateY(-50%);
                color: #7c3aed;
                font-size: 1.5rem;
                background: #ede9fe;
                border-radius: 50%;
                width: 38px;
                height: 38px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 1px 4px rgba(124,58,237,0.08);
            }
            @media (max-width: 900px) {
                .why-section { padding: 24px 8vw 24px 8vw; }
                .why-section h2 { font-size: 1.5rem; }
                .why-desc { font-size: 1.05rem; }
                .why-list li { font-size: 1rem; padding: 14px 12px 14px 48px; }
                .why-icon { width: 28px; height: 28px; font-size: 1.1rem; }
            }
            /* two-column layout for the Why section: image left, content right */
            .why-flex { display:flex; gap:28px; align-items:flex-start; }
            .why-image { flex:0 0 360px; }
            .why-image img { width:100%; height:auto; border-radius:12px; box-shadow:0 8px 24px rgba(162, 214, 17, 0.12); display:block; }
            .why-content { flex:1; }
            @media (max-width: 900px) {
                .why-flex { flex-direction:column; }
                .why-image { flex: none; width: 100%; }
            }
/* Banner */
.banner {
    margin-top:30px;
    background: url('images/banner.jpg') no-repeat center center/cover;
    color:#fff; 
    padding:100px 30px; 
    text-align:center; 
    position:relative;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.3);
    overflow:hidden;
}

/* Ensure content stacking context remains normal on white background */
header, .banner, .section, .section1, footer, .form-container, .services {
    position: relative;
    z-index: auto;
}

/* Overlay effect */
.banner::after {
    content:"";
    position:absolute;
    top:0; left:0; right:0; bottom:0;
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7));
    z-index:1;
}

/* Banner text */
.banner h2, .banner p {
    position:relative;
    z-index:2;
}
.banner h2 {
    font-size:48px; 
    margin-bottom:15px;
    font-weight:700;
    letter-spacing:2px;
    text-transform:uppercase;
    animation: fadeInDown 1.2s ease;
}
.banner p {
    font-size:22px;
    max-width:700px;
    margin:0 auto;
    line-height:1.6;
    animation: fadeInUp 1.2s ease;
}

/* Button in banner (optional CTA) */
.banner a {
    position:relative;
    z-index:2;
    display:inline-block;
    margin-top:20px;
    padding:12px 30px;
    background:#f39c12;
    color:#fff;
    font-weight:bold;
    border-radius:6px;
    text-decoration:none;
    transition:0.3s;
}
.banner a:hover {
    background:#d35400;
    transform:scale(1.05);
}

/* Animation keyframes */
@keyframes fadeInDown {
    from {opacity:0; transform:translateY(-30px);}
    to {opacity:1; transform:translateY(0);}
}
@keyframes fadeInUp {
    from {opacity:0; transform:translateY(30px);}
    to {opacity:1; transform:translateY(0);}
}

/* Responsive banner */
@media (max-width:768px) {
    .banner {
        padding:60px 20px;
    }
    .banner h2 {
        font-size:32px;
    }
    .banner p {
        font-size:18px;
    }
    /* avoid fixed background on small screens for performance */
    body {
        background-attachment: scroll;
    }
}


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
/* Sections */
.section, .section1 {
    margin: 36px auto;
    max-width: 950px;
    border-radius: 22px;
    box-shadow: 0 6px 24px rgba(44,62,80,0.10);
    width: 65%;
    padding: 42px 32px 36px 32px;
    background: linear-gradient(120deg, #e0f7fa 0%, #f3e8ff 100%);
    color: #333;
    border: 2.5px solid #2c3e50;
}
.section h2, .section1 h2 {
    text-align: center;
    margin-bottom: 32px;
    color: #2c3e50;
    font-size: 2.5rem;
    font-weight: 800;
    letter-spacing: 1px;
    text-shadow: 0 2px 8px rgba(44,62,80,0.08);
}

/* Services */
/* Services */
.services {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 32px;
}
.service-box {
    width: 30%;
    min-width: 260px;
    background: #fff;
    padding: 38px 24px 32px 24px;
    border-radius: 18px;
    text-align: center;
    box-shadow: 0 3px 18px rgba(44,62,80,0.10);
    transition: 0.3s;
    position: relative;
    overflow: hidden;
    border: 2.5px solid #f39c12;
}
.service-box:hover {
    transform: translateY(-8px) scale(1.04);
    box-shadow: 0 8px 24px rgba(44,62,80,0.18);
    border-color: #7c3aed;
}
.service-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #7c3aed 60%, #f39c12 100%);
    color: #fff;
    font-size: 2rem;
    margin: 0 auto 18px auto;
    box-shadow: 0 2px 8px rgba(44,62,80,0.10);
    animation: popIn 1.1s;
}
.service-box:nth-child(1) .service-icon {
    background: linear-gradient(135deg, #e84393 60%, #fdcb6e 100%);
}
.service-box:nth-child(2) .service-icon {
    background: linear-gradient(135deg, #00b894 60%, #00cec9 100%);
}
.service-box:nth-child(3) .service-icon {
    background: linear-gradient(135deg, #0984e3 60%, #6c5ce7 100%);
}
.service-box h3 {
    color: #2c3e50;
    margin-bottom: 10px;
    font-size: 1.4rem;
    font-weight: 700;
}
.service-box p {
    font-size: 1.08rem;
    color: #666;
    margin-bottom: 18px;
}
.service-box a {
    display: inline-block;
    margin-top: 10px;
    padding: 12px 28px;
    background: #2c3e50;
    color: #fff;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.08rem;
    transition: 0.3s;
    box-shadow: 0 1px 4px rgba(44,62,80,0.08);
}
.service-box a:hover {
    background: #f39c12;
    color: #fff;
    transform: scale(1.07);
}
@keyframes popIn {
    0% { opacity: 0; transform: scale(0.7); }
    80% { opacity: 1; transform: scale(1.1); }
    100% { opacity: 1; transform: scale(1); }
}
@media (max-width: 900px) {
    .section, .section1 { padding: 18px 4vw 18px 4vw; }
    .section h2, .section1 h2 { font-size: 1.5rem; }
    .services { gap: 18px; }
    .service-box { width: 90%; min-width: 180px; padding: 18px 8px 18px 8px; }
    .service-icon { width: 38px; height: 38px; font-size: 1.1rem; }
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
/* Mobile responsive */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        text-align: center;
    }
}

img {
    max-width: 100%;
    height: auto;
}

    </style>
</head>
<body>
<header>
    <h1 class="header1">SARA DJ Booking System</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="services.php">DJ Services</a>
        <a href="request_status.php">Request Status</a>
        <a href="contact.php">Contact</a>
        <a href="admin_login.php">Admin Login</a>
    </nav>
</header>

<!-- Banner Section -->
<div class="banner">
    <h2>Welcome to SARA DJ Booking</h2>
    <p>Your one-stop solution for unforgettable music experiences</p>
</div>

<!-- Why Choose Us Section with left image -->


<!-- Featured Services Section -->
<div class="section1">
    <h2 style="text-align:center; color: #2c3e50; margin-top: 10%;">Our Featured Services</h2>
    <div class="services">
        <div class="service-box">
            <h3>Wedding DJ</h3>
            <p>Make your wedding unforgettable with our professional DJ services.</p>
            <a href="services.php">Book Now</a>
        </div>
        <div class="service-box">
            <h3>Birthday Party DJ</h3>
            <p>Turn up the fun on your special day with beats that everyone loves.</p>
            <a href="services.php">Book Now</a>
        </div>
        <div class="service-box">
            <h3>Corporate Events</h3>
            <p>Create the perfect atmosphere for business parties and team events.</p>
            <a href="services.php">Book Now</a>
        </div>
    </div>
</div>
<div class="section" style="text-align:left; margin:36px auto; width:70%;">
    <div class="why-flex">
        <div class="why-image">
            <img src="images/index.jpg" alt="DJ turntable with crown">
        </div>
        <div class="why-content">
            <h2 style="text-align:left; color:#333; margin-top:6%">Why Choose SARA DJ?</h2>
            <p style="text-align:left; color:#333; margin-top:12px;"></p>
           <ul class="why-list">
            <li>Professional & Experienced DJs</li>
            <li>Customized Music Experience</li>
            <li>Reliable Service </li>
            <li>Affordable Packages</li>
        </ul>
        </div>
    </div>

</div>

<footer style="margin-top: 5%;">
    <p > &copy; 2025 SARA DJ Booking. All Rights Reserved.</p>
    <p><a href="#">Privacy Policy</a> | <a href="#">Terms</a></p>
</footer>
</body>
</html>
