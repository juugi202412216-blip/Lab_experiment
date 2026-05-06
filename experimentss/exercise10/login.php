<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TechStore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 TechStore</h1>
            <p>User Login</p>
        </header>
        
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="cart.php">Cart</a>
            <a href="profile.php">Profile</a>
        </nav>
        
        <main>
            <?php
            session_start();
            
            // Check if already logged in
            if (isset($_SESSION['user_id'])) {
                header("Location: profile.php");
                exit();
            }
            
            $error = '';
            $success = '';
            
            // Check for remember me cookie
            if (isset($_COOKIE['remember_user']) && !isset($_SESSION['user_id'])) {
                $success = 'Welcome back! We remembered you from your last visit.';
            }
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = trim($_POST['username'] ?? '');
                $password = $_POST['password'] ?? '';
                $remember = isset($_POST['remember']);
                
                // Simple validation (in real app, check against database)
                if ($username === 'demo' && $password === 'demo123') {
                    // Set session variables
                    $_SESSION['user_id'] = 1;
                    $_SESSION['username'] = $username;
                    $_SESSION['login_time'] = time();
                    
                    // Set cookie if remember me is checked
                    if ($remember) {
                        setcookie('remember_user', $username, time() + (86400 * 30), "/"); // 30 days
                        setcookie('user_theme', 'default', time() + (86400 * 30), "/");
                    }
                    
                    header("Location: profile.php");
                    exit();
                } else {
                    $error = 'Invalid username or password';
                }
            }
            ?>
            
            <div class="form-container">
                <h2>Login to Your Account</h2>
                
                <?php if ($error): ?>
                    <div class="error">❌ <?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="success">✓ <?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" 
                               value="<?php echo isset($_COOKIE['remember_user']) ? htmlspecialchars($_COOKIE['remember_user']) : ''; ?>" 
                               placeholder="Enter username" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" 
                               placeholder="Enter password" required>
                    </div>
                    
                    <div class="form-group">
                        <label style="display: flex; align-items: center; font-weight: normal;">
                            <input type="checkbox" name="remember" style="width: auto; margin-right: 8px;" 
                                   <?php echo isset($_COOKIE['remember_user']) ? 'checked' : ''; ?>>
                            Remember me for 30 days
                        </label>
                    </div>
                    
                    <button type="submit" class="btn">Login</button>
                </form>
                
                <div style="margin-top: 20px; padding: 15px; background: #e7f3ff; border-radius: 8px;">
                    <strong style="color: #1e3c72;">Demo Credentials:</strong><br>
                    <span style="color: #666;">Username: demo | Password: demo123</span>
                </div>
            </div>
            
            <a href="../index.html" class="back-link">← Back to Main Index</a>
        </main>
        
        <footer>
            <p>&copy; 2023 TechStore | Exercise 10</p>
        </footer>
    </div>
</body>
</html>
