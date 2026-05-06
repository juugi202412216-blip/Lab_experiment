<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - PHP Validation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>User Registration</h1>
            <p>PHP Server-side Validation</p>
        </header>
        
        <nav>
            <a href="index.html">Home</a>
            <a href="contact_form.php">Contact Form</a>
            <a href="registration_form.php">Registration</a>
        </nav>
        
        <main>
            <div class="form-container">
                <h2>Create Account</h2>
                
                <?php
                $errors = [];
                $success = false;
                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Sanitize inputs
                    $fullname = trim($_POST['fullname'] ?? '');
                    $email = trim($_POST['email'] ?? '');
                    $phone = trim($_POST['phone'] ?? '');
                    $password = $_POST['password'] ?? '';
                    $confirm_password = $_POST['confirm_password'] ?? '';
                    
                    // Validation
                    if (empty($fullname)) {
                        $errors[] = "Full name is required";
                    } elseif (strlen($fullname) < 3) {
                        $errors[] = "Name must be at least 3 characters";
                    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
                        $errors[] = "Name can only contain letters and spaces";
                    }
                    
                    if (empty($email)) {
                        $errors[] = "Email is required";
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Invalid email format";
                    }
                    
                    if (empty($phone)) {
                        $errors[] = "Phone number is required";
                    } elseif (!preg_match("/^[6-9]\d{9}$/", $phone)) {
                        $errors[] = "Invalid Indian phone number (must be 10 digits starting with 6-9)";
                    }
                    
                    if (empty($password)) {
                        $errors[] = "Password is required";
                    } elseif (strlen($password) < 8) {
                        $errors[] = "Password must be at least 8 characters";
                    } elseif (!preg_match("/[A-Z]/", $password)) {
                        $errors[] = "Password must contain at least one uppercase letter";
                    } elseif (!preg_match("/[a-z]/", $password)) {
                        $errors[] = "Password must contain at least one lowercase letter";
                    } elseif (!preg_match("/[0-9]/", $password)) {
                        $errors[] = "Password must contain at least one number";
                    }
                    
                    if (empty($confirm_password)) {
                        $errors[] = "Please confirm your password";
                    } elseif ($password !== $confirm_password) {
                        $errors[] = "Passwords do not match";
                    }
                    
                    // If no errors, process registration
                    if (empty($errors)) {
                        $success = true;
                        // Here you would typically:
                        // 1. Hash the password
                        // 2. Save to database
                        // 3. Send confirmation email
                        // For demo, we just show success
                    }
                }
                ?>
                
                <?php if (!empty($errors)): ?>
                    <div class="error">
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin-top: 10px; margin-left: 20px;">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="success">
                        <strong>✓ Registration Successful!</strong><br>
                        Welcome, <?php echo htmlspecialchars($fullname); ?>!<br>
                        Your account has been created successfully.<br>
                        A confirmation email has been sent to <?php echo htmlspecialchars($email); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="fullname">Full Name *</label>
                        <input type="text" id="fullname" name="fullname" 
                               value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>" 
                               placeholder="Enter your full name">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                               placeholder="Enter your email">
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" 
                               value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" 
                               placeholder="Enter 10-digit phone number">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" 
                               placeholder="Create a strong password">
                        <small style="color: #666; font-size: 12px;">
                            Must be 8+ characters with uppercase, lowercase, and numbers
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password *</label>
                        <input type="password" id="confirm_password" name="confirm_password" 
                               placeholder="Re-enter your password">
                    </div>
                    
                    <button type="submit" class="btn">Register</button>
                </form>
            </div>
            
            <a href="../index.html" class="back-link">← Back to Main Index</a>
        </main>
        
        <footer>
            <p>&copy; 2023 PHP Form Handling | Exercise 8</p>
        </footer>
    </div>
</body>
</html>
