<?php
// Simple admin seed script — visit in browser to create demo tables & data.
// WARNING: Intended for local/dev only.
require_once __DIR__ . '/../includes/dbconnection.php';

try {
    // Create users table if missing
    $dbh->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        mobile VARCHAR(20) NOT NULL,
        password VARCHAR(255) DEFAULT '',
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create tblbooking (booking) table if missing
    $dbh->exec("CREATE TABLE IF NOT EXISTS tblbooking (
        ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        BookingID VARCHAR(50) NOT NULL,
        ServiceID VARCHAR(100) NOT NULL,
        Name VARCHAR(100) NOT NULL,
        MobileNumber VARCHAR(20) NOT NULL,
        Email VARCHAR(100) NOT NULL,
        EventDate DATE,
        EventStartingtime VARCHAR(20),
        EventEndingtime VARCHAR(20),
        VenueAddress VARCHAR(255),
        EventType VARCHAR(100),
        AdditionalInformation TEXT,
        BookingDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Create bookings fallback table if missing
    $dbh->exec("CREATE TABLE IF NOT EXISTS bookings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL,
        mobile VARCHAR(20) NOT NULL,
        service VARCHAR(100) DEFAULT '',
        status VARCHAR(50) DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Insert demo users (ignore duplicates)
    $insertUser = $dbh->prepare('INSERT INTO users (username,email,mobile,password) VALUES (:u,:e,:m,:p)');
    $demoUsers = [
        ['u' => 'ravi', 'e' => 'ravi@example.com', 'm' => '9876543210', 'p' => ''],
        ['u' => 'priya', 'e' => 'priya@example.com', 'm' => '9123456780', 'p' => ''],
    ];
    foreach ($demoUsers as $du) {
        try { $insertUser->execute([':u'=>$du['u'],':e'=>$du['e'],':m'=>$du['m'],':p'=>$du['p']]); } catch (Exception $ignore) {}
    }

    // Insert demo tblbooking rows
    $insertBooking = $dbh->prepare('INSERT INTO tblbooking (BookingID,ServiceID,Name,MobileNumber,Email,EventDate,EventStartingtime,EventEndingtime,VenueAddress,EventType) VALUES (:bid,:sid,:name,:mobile,:email,:edate,:st,:et,:venue,:etype)');
    $demoBook = [
        ['bid'=>'BK-1001','sid'=>'S1','name'=>'Ravi','mobile'=>'9876543210','email'=>'ravi@example.com','edate'=>'2025-11-01','st'=>'18:00','et'=>'23:00','venue'=>'Mumbai Hall','etype'=>'Wedding'],
        ['bid'=>'BK-1002','sid'=>'S2','name'=>'Priya','mobile'=>'9123456780','email'=>'priya@example.com','edate'=>'2025-12-05','st'=>'19:00','et'=>'22:00','venue'=>'Banquet Hall','etype'=>'Birthday']
    ];
    foreach ($demoBook as $dbk) {
        try { $insertBooking->execute([':bid'=>$dbk['bid'],':sid'=>$dbk['sid'],':name'=>$dbk['name'],':mobile'=>$dbk['mobile'],':email'=>$dbk['email'],':edate'=>$dbk['edate'],':st'=>$dbk['st'],':et'=>$dbk['et'],':venue'=>$dbk['venue'],':etype'=>$dbk['etype']]); } catch (Exception $ignore) {}
    }

    // Insert fallback bookings
    $insertBk2 = $dbh->prepare('INSERT INTO bookings (username,mobile,service,status) VALUES (:u,:m,:s,:st)');
    try { $insertBk2->execute([':u'=>'ravi',':m'=>'9876543210',':s'=>'Wedding DJ',':st'=>'Approved']); } catch (Exception $ignore) {}

    echo "Demo data seeded successfully.\n";
    echo "Visit admin/user_search.php and search for 'ravi', 'priya', '9876543210', or BookingID 'BK-1001'.";

} catch (Exception $e) {
    echo "Failed to seed demo data: " . htmlspecialchars($e->getMessage());
}

?>
