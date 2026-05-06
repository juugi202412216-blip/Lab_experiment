# Web Technology Lab Experiments - Setup Instructions

## 📋 Overview

This repository contains all 10 lab exercises for the Web Technology course (B.Tech Computer Science and Engineering 2023). Each exercise is organized in its own folder and linked from the main `index.html` file.

## 🗂️ Project Structure

```
lab_experiments/
├── index.html                    # Main landing page
├── README.md                     # Project documentation
├── SETUP_INSTRUCTIONS.md         # This file
│
├── exercise1/                    # Personal Website (Basic HTML)
│   ├── index.html
│   ├── about.html
│   ├── portfolio.html
│   └── contact.html
│
├── exercise2/                    # E-Commerce Website (Advanced HTML)
│   ├── index.html
│   ├── products.html
│   ├── cart.html
│   └── about.html
│
├── exercise3/                    # Personal Website with CSS
│   ├── index.html
│   ├── about.html
│   ├── portfolio.html
│   ├── contact.html
│   └── styles.css
│
├── exercise4/                    # E-Commerce Website with CSS
│   ├── index.html
│   ├── products.html
│   ├── cart.html
│   ├── about.html
│   └── styles.css
│
├── exercise5/                    # Scientific Calculator (JavaScript)
│   └── index.html
│
├── exercise6/                    # Registration & Login Forms (JS Validation)
│   ├── index.html
│   ├── register.html
│   ├── login.html
│   └── styles.css
│
├── exercise7/                    # Event Handling
│   ├── index.html
│   ├── script.js
│   └── styles.css
│
├── exercise8/                    # PHP Form Handling
│   ├── index.html
│   ├── contact_form.php
│   ├── registration_form.php
│   └── styles.css
│
├── exercise9/                    # PHP & MySQL Integration
│   ├── index.php
│   ├── add_product.php
│   ├── edit_product.php
│   ├── view_product.php
│   ├── config.php
│   └── styles.css
│
└── exercise10/                   # Sessions & Cookies
    ├── index.php
    ├── login.php
    ├── profile.php
    ├── products.php
    ├── cart.php
    ├── preferences.php
    ├── logout.php
    └── styles.css
```

## 🚀 Getting Started

### Exercises 1-7 (HTML, CSS, JavaScript)

These exercises can be run directly in any modern web browser without any server setup.

**Steps:**
1. Open `index.html` in your web browser
2. Click on any exercise card to view that exercise
3. Navigate through the pages using the navigation links

**Supported Browsers:**
- Google Chrome (Recommended)
- Mozilla Firefox
- Microsoft Edge
- Safari

### Exercises 8-10 (PHP & MySQL)

These exercises require a local server environment.

## 🔧 PHP & MySQL Setup

### Option 1: XAMPP (Recommended for Windows)

1. **Download XAMPP**
   - Visit: https://www.apachefriends.org/
   - Download the latest version for your OS
   - Install XAMPP

2. **Setup Project**
   ```bash
   # Copy the entire lab_experiments folder to:
   C:\xampp\htdocs\lab_experiments
   ```

3. **Start Services**
   - Open XAMPP Control Panel
   - Start Apache server
   - Start MySQL server

4. **Access the Project**
   - Open browser and go to: `http://localhost/lab_experiments/`

### Option 2: WAMP (Windows)

1. **Download WAMP**
   - Visit: https://www.wampserver.com/
   - Download and install

2. **Setup Project**
   ```bash
   # Copy the folder to:
   C:\wamp64\www\lab_experiments
   ```

3. **Start Services**
   - Launch WAMP
   - Wait for icon to turn green

4. **Access the Project**
   - Go to: `http://localhost/lab_experiments/`

### Option 3: LAMP (Linux)

1. **Install LAMP Stack**
   ```bash
   sudo apt update
   sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql
   ```

2. **Setup Project**
   ```bash
   sudo cp -r lab_experiments /var/www/html/
   sudo chmod -R 755 /var/www/html/lab_experiments
   ```

3. **Start Services**
   ```bash
   sudo systemctl start apache2
   sudo systemctl start mysql
   ```

4. **Access the Project**
   - Go to: `http://localhost/lab_experiments/`

### Option 4: MAMP (macOS)

1. **Download MAMP**
   - Visit: https://www.mamp.info/
   - Download and install

2. **Setup Project**
   ```bash
   # Copy the folder to:
   /Applications/MAMP/htdocs/lab_experiments
   ```

3. **Start Services**
   - Launch MAMP
   - Click "Start Servers"

4. **Access the Project**
   - Go to: `http://localhost:8888/lab_experiments/`

## 📊 Database Setup (Exercise 9)

Exercise 9 automatically creates the database and tables on first run. However, if you encounter issues:

### Manual Database Setup

1. **Access phpMyAdmin**
   - XAMPP: `http://localhost/phpmyadmin`
   - WAMP: `http://localhost/phpmyadmin`
   - LAMP: `http://localhost/phpmyadmin`

2. **Create Database**
   ```sql
   CREATE DATABASE techstore_db;
   USE techstore_db;
   
   CREATE TABLE products (
       id INT(11) AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       description TEXT,
       price DECIMAL(10, 2) NOT NULL,
       category VARCHAR(100),
       stock INT(11) DEFAULT 0,
       image_url VARCHAR(255),
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );
   ```

3. **Insert Sample Data** (Optional)
   ```sql
   INSERT INTO products (name, description, price, category, stock, image_url) VALUES
   ('Dell Inspiron 15', 'High-performance laptop', 45000, 'Laptops', 10, '💻'),
   ('Samsung Galaxy A54', 'Latest 5G smartphone', 25000, 'Smartphones', 25, '📱'),
   ('Sony WH-1000XM4', 'Wireless headphones', 5000, 'Audio', 15, '🎧');
   ```

### Database Configuration

If you need to change database credentials, edit `exercise9/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');           // Change if needed
define('DB_PASS', '');               // Add password if set
define('DB_NAME', 'techstore_db');
```

## 🔐 Demo Credentials

### Exercise 6 & 10 (Login System)
- **Username:** demo
- **Password:** demo123

## 📝 Exercise Details

### Exercise 1: Personal Website (Basic HTML)
- 4 pages: Home, About, Portfolio, Contact
- Basic HTML tags: headings, paragraphs, lists, links, forms

### Exercise 2: E-Commerce Website (Advanced HTML)
- 4 pages: Home, Products, Cart, About
- Advanced HTML: tables, forms, semantic tags

### Exercise 3: Personal Website with CSS
- Enhanced Exercise 1 with:
  - Inline CSS
  - Internal CSS
  - External CSS (styles.css)

### Exercise 4: E-Commerce Website with CSS
- Enhanced Exercise 2 with:
  - Inline CSS
  - Internal CSS
  - External CSS (styles.css)

### Exercise 5: Scientific Calculator
- Fully functional calculator
- JavaScript operations
- Keyboard support
- Error handling

### Exercise 6: Registration & Login Forms
- Client-side validation using JavaScript
- Real-time form validation
- Password strength checker
- Email validation

### Exercise 7: Event Handling
- Click events
- Double-click events
- Mouse hover events
- Keyboard events
- Form events
- Dropdown change events
- Context menu events
- Load events

### Exercise 8: PHP Form Handling
- Server-side validation
- Contact form
- Registration form
- Input sanitization
- Error handling

### Exercise 9: PHP & MySQL Integration
- CRUD operations (Create, Read, Update, Delete)
- Product management system
- Database connectivity
- Form processing
- Data validation

### Exercise 10: Sessions & Cookies
- User authentication with sessions
- Shopping cart using sessions
- Remember me with cookies
- User preferences stored in cookies
- Session management
- Cookie expiration

## 🐛 Troubleshooting

### Common Issues

**1. PHP files download instead of executing**
- Solution: Make sure Apache server is running
- Check that PHP module is enabled in Apache

**2. Database connection error**
- Solution: Verify MySQL is running
- Check database credentials in config.php
- Ensure database exists

**3. Session not working**
- Solution: Check that session.save_path is writable
- Verify PHP session extension is enabled

**4. Blank page on PHP files**
- Solution: Check PHP error logs
- Enable error display in php.ini:
  ```ini
  display_errors = On
  error_reporting = E_ALL
  ```

**5. Permission denied errors (Linux)**
- Solution: Set proper permissions:
  ```bash
  sudo chmod -R 755 /var/www/html/lab_experiments
  sudo chown -R www-data:www-data /var/www/html/lab_experiments
  ```

## 📚 Technologies Used

- **HTML5** - Structure and content
- **CSS3** - Styling and layout
- **JavaScript** - Client-side interactivity
- **PHP** - Server-side processing
- **MySQL** - Database management

## 🎯 Learning Objectives

By completing these exercises, you will learn:

1. ✅ HTML fundamentals and semantic markup
2. ✅ CSS styling techniques (inline, internal, external)
3. ✅ JavaScript programming and DOM manipulation
4. ✅ Event handling and user interactions
5. ✅ Form validation (client-side and server-side)
6. ✅ PHP programming and server-side logic
7. ✅ Database operations with MySQL
8. ✅ Session management and state persistence
9. ✅ Cookie handling and user preferences
10. ✅ Full-stack web development workflow

## 📞 Support

If you encounter any issues:

1. Check the troubleshooting section above
2. Verify all prerequisites are installed
3. Check server logs for errors
4. Ensure all files are in the correct directories

## 📄 License

This project is created for educational purposes as part of the Web Technology Lab course.

## 👨‍💻 Author

B.Tech Computer Science and Engineering Student
Faculty of Engineering and Technology - 2023

---

**Happy Coding! 🚀**
