-- DJ Booking System: Table for PHP compatibility
CREATE TABLE tblbooking (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    BookingID VARCHAR(20) NOT NULL,
    ServiceID VARCHAR(100) NOT NULL,
    Name VARCHAR(100) NOT NULL,
    MobileNumber VARCHAR(20) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    EventDate DATE NOT NULL,
    EventStartingtime VARCHAR(20) NOT NULL,
    EventEndingtime VARCHAR(20) NOT NULL,
    VenueAddress VARCHAR(255) NOT NULL,
    EventType VARCHAR(100) NOT NULL,
    AdditionalInformation TEXT,
    BookingDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Users table (for user registration/login)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

-- Bookings table (to store user DJ booking requests)
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    service VARCHAR(100) NOT NULL,
    status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE
);

-- Admin table (optional, you can hardcode login too)
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
);

-- Insert default admin
INSERT INTO admin (username, password) VALUES ('admin', 'admin123');

-- -- Insert some sample bookings (optional test data)
-- INSERT INTO bookings (username, mobile, service, status) 
-- VALUES 
-- ('testuser', '9876543210', 'Wedding DJ', 'Approved'),
-- ('testuser', '9876543210', 'Birthday Party DJ', 'Pending'),
-- ('demo', '9123456780', 'Corporate Event DJ', 'Rejected');


-- -- Admin Table
-- CREATE TABLE admin (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(50) NOT NULL UNIQUE,
--     password VARCHAR(255) NOT NULL
-- );

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    mobile VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Event Types Table
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bookings Table
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    event_id INT NOT NULL,
    booking_date DATE NOT NULL,
    status ENUM('Pending','Approved','Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

-- Contact Queries Table
CREATE TABLE contact_queries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('Unread','Read') DEFAULT 'Unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Pages Table (for About Us & Contact Us Content)
CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_name VARCHAR(50) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert Default Admin
INSERT INTO admin (username, password) VALUES ('admin', MD5('admin123'));

-- Insert Default Pages
INSERT INTO pages (page_name, content) VALUES
('about', 'Welcome to SARA DJ Service – We bring energy, excitement, and unforgettable music to your events.'),
('contact', 'SARA DJ Services, Phone: +91 9876543210, Email: info@saradjs.com, Address: Mumbai, India');
-- CREATE TABLE users (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(100),
--     email VARCHAR(100) UNIQUE,
--     password VARCHAR(255)
-- );
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS contact_queries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  message TEXT NOT NULL,
  status ENUM('Unread','Read') DEFAULT 'Unread',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);  
CREATE TABLE pages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  page_name VARCHAR(50) UNIQUE,
  content TEXT
);
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'customer') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO users (username, email, password, role)
VALUES (
    'dani',
    'admin@gmail.com',
    '$2y$10$2k7ah6L8rA27UBl3fncGBevz4a8aUxjRNNuJ5HGlcU7N8lRrP9n3i', -- password: admin123
    'admin'
);
