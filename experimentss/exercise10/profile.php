<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - TechStore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 TechStore</h1>
            <p>User Profile</p>
        </header>
        
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="cart.php">Cart</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
        
        <main>
            <?php
            session_start();
            
            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                header("Location: login.php");
                exit();
            }
            
            $username = $_SESSION['username'];
            $login_time = $_SESSION['login_time'];
            $session_duration = time() - $login_time;
            $minutes = floor($session_duration / 60);
            $seconds = $session_duration % 60;
            ?>
            
            <div class="hero-section">
                <h2>Welcome, <?php echo htmlspecialchars($username); ?>! 👋</h2>
                <p>Your profile and session information</p>
            </div>
            
            <div class="profile-container">
                <div class="profile-card">
                    <h3>Session Information</h3>
                    <div class="info-item">
                        <strong>Session ID:</strong> <?php echo session_id(); ?>
                    </div>
                    <div class="info-item">
                        <strong>Username:</strong> <?php echo htmlspecialchars($username); ?>
                    </div>
                    <div class="info-item">
                        <strong>Login Time:</strong> <?php echo date('F j, Y, g:i a', $login_time); ?>
                    </div>
                    <div class="info-item">
                        <strong>Session Duration:</strong> <?php echo $minutes; ?> minutes, <?php echo $seconds; ?> seconds
                    </div>
                    <div class="info-item">
                        <strong>User ID:</strong> <?php echo $_SESSION['user_id']; ?>
                    </div>
                </div>
                
                <div class="profile-card">
                    <h3>Cookie Information</h3>
                    <?php if (isset($_COOKIE['remember_user'])): ?>
                        <div class="info-item">
                            <strong>Remember Me:</strong> ✓ Enabled
                        </div>
                        <div class="info-item">
                            <strong>Remembered User:</strong> <?php echo htmlspecialchars($_COOKIE['remember_user']); ?>
                        </div>
                    <?php else: ?>
                        <div class="info-item">
                            <strong>Remember Me:</strong> ✗ Not enabled
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_COOKIE['user_theme'])): ?>
                        <div class="info-item">
                            <strong>Theme Preference:</strong> <?php echo htmlspecialchars($_COOKIE['user_theme']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_COOKIE['last_visit'])): ?>
                        <div class="info-item">
                            <strong>Last Visit:</strong> <?php echo htmlspecialchars($_COOKIE['last_visit']); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="profile-card">
                    <h3>Shopping Cart</h3>
                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <div class="info-item">
                            <strong>Items in Cart:</strong> <?php echo count($_SESSION['cart']); ?>
                        </div>
                        <a href="cart.php" class="btn">View Cart</a>
                    <?php else: ?>
                        <div class="info-item">
                            <strong>Cart Status:</strong> Empty
                        </div>
                        <a href="products.php" class="btn">Browse Products</a>
                    <?php endif; ?>
                </div>
                
                <div class="profile-card">
                    <h3>Account Actions</h3>
                    <a href="preferences.php" class="btn">Update Preferences</a>
                    <a href="logout.php" class="btn btn-delete">Logout</a>
                </div>
            </div>
            
            <section style="margin-top: 40px; background: #fff3cd; padding: 20px; border-radius: 10px;">
                <h3 style="color: #856404; margin-bottom: 10px;">💡 Session & Cookie Demo</h3>
                <p style="color: #856404; line-height: 1.8;">
                    This page demonstrates:<br>
                    • Session variables storing user login information<br>
                    • Cookies remembering user preferences<br>
                    • Session duration tracking<br>
                    • Shopping cart state management<br>
                    • Secure session handling
                </p>
            </section>
            
            <a href="../index.html" class="back-link">← Back to Main Index</a>
        </main>
        
        <footer>
            <p>&copy; 2023 TechStore | Exercise 10</p>
        </footer>
    </div>
</body>
</html>
