<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form - PHP Validation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Contact Form</h1>
            <p>PHP Server-side Validation</p>
        </header>
        
        <nav>
            <a href="index.html">Home</a>
            <a href="contact_form.php">Contact Form</a>
            <a href="registration_form.php">Registration</a>
        </nav>
        
        <main>
            <div class="form-container">
                <h2>Get In Touch</h2>
                
                <?php
                $errors = [];
                $success = false;
                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Sanitize and validate inputs
                    $name = trim($_POST['name'] ?? '');
                    $email = trim($_POST['email'] ?? '');
                    $subject = trim($_POST['subject'] ?? '');
                    $message = trim($_POST['message'] ?? '');
                    
                    // Validation
                    if (empty($name)) {
                        $errors[] = "Name is required";
                    } elseif (strlen($name) < 3) {
                        $errors[] = "Name must be at least 3 characters";
                    }
                    
                    if (empty($email)) {
                        $errors[] = "Email is required";
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Invalid email format";
                    }
                    
                    if (empty($subject)) {
                        $errors[] = "Subject is required";
                    }
                    
                    if (empty($message)) {
                        $errors[] = "Message is required";
                    } elseif (strlen($message) < 10) {
                        $errors[] = "Message must be at least 10 characters";
                    }
                    
                    // If no errors, process the form
                    if (empty($errors)) {
                        $success = true;
                        // Here you would typically send an email or save to database
                        // For demo purposes, we just show success message
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
                        <strong>✓ Success!</strong><br>
                        Thank you, <?php echo htmlspecialchars($name); ?>! Your message has been received.<br>
                        We'll get back to you at <?php echo htmlspecialchars($email); ?> soon.
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" 
                               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" 
                               placeholder="Enter your name">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                               placeholder="Enter your email">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" 
                               value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>" 
                               placeholder="Enter subject">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" placeholder="Enter your message"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn">Send Message</button>
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
