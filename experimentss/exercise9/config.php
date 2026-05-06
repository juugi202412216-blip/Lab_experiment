<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'techstore_db');

// Create connection
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

// Create database and table if they don't exist
function initializeDatabase() {
    // Connect without database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    $conn->query($sql);
    
    // Select database
    $conn->select_db(DB_NAME);
    
    // Create products table
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10, 2) NOT NULL,
        category VARCHAR(100),
        stock INT(11) DEFAULT 0,
        image_url VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->query($sql);
    
    // Insert sample data if table is empty
    $result = $conn->query("SELECT COUNT(*) as count FROM products");
    $row = $result->fetch_assoc();
    
    if ($row['count'] == 0) {
        $sampleProducts = [
            ['Dell Inspiron 15', 'High-performance laptop with Intel Core i5, 16GB RAM, 512GB SSD', 45000, 'Laptops', 10, '💻'],
            ['Samsung Galaxy A54', 'Latest 5G smartphone with 128GB storage and 48MP camera', 25000, 'Smartphones', 25, '📱'],
            ['Sony WH-1000XM4', 'Wireless noise-cancelling headphones with 30-hour battery', 5000, 'Audio', 15, '🎧'],
            ['Canon EOS 1500D', 'DSLR camera with 24.1MP sensor and WiFi connectivity', 35000, 'Cameras', 8, '📷'],
            ['Apple Watch Series 8', 'Smartwatch with health tracking and fitness features', 40000, 'Wearables', 12, '⌚'],
            ['Logitech MX Master 3', 'Wireless mouse with ergonomic design', 8000, 'Accessories', 20, '🖱️']
        ];
        
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, category, stock, image_url) VALUES (?, ?, ?, ?, ?, ?)");
        
        foreach ($sampleProducts as $product) {
            $stmt->bind_param("ssdsis", $product[0], $product[1], $product[2], $product[3], $product[4], $product[5]);
            $stmt->execute();
        }
        
        $stmt->close();
    }
    
    $conn->close();
}

// Initialize database on first load
initializeDatabase();
?>
