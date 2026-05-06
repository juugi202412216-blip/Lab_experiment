<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 10 - Sessions & Cookies</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 TechStore</h1>
            <p>Sessions & Cookies Demo - Exercise 10</p>
        </header>
        
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="cart.php">Cart</a>
            <a href="profile.php">Profile</a>
        </nav>
        
        <main>
            <div class="hero-section">
                <h2>Welcome to TechStore</h2>
                <p>Demonstrating Sessions and Cookies in PHP</p>
            </div>
            
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-icon">🔐</div>
                    <h3>User Sessions</h3>
                    <p>Login system using PHP sessions to maintain user state across pages</p>
                    <a href="login.php" class="btn">Login</a>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">🛍️</div>
                    <h3>Shopping Cart</h3>
                    <p>Add products to cart and maintain cart state using sessions</p>
                    <a href="products.php" class="btn">Browse Products</a>
                </div>
                
                <div class="info-card">
                    <div class="info-icon">🍪</div>
                    <h3>Remember Me</h3>
                    <p>Use cookies to remember user preferences and login information</p>
                    <a href="preferences.php" class="btn">Set Preferences</a>
                </div>
            </div>
            
            <section style="margin-top: 40px;">
                <h2>Features Demonstrated</h2>
                <div class="features-list">
                    <div class="feature-item">✓ User authentication with sessions</div>
                    <div class="feature-item">✓ Shopping cart using session variables</div>
                    <div class="feature-item">✓ Remember me functionality with cookies</div>
                    <div class="feature-item">✓ User preferences stored in cookies</div>
                    <div class="feature-item">✓ Session management and security</div>
                    <div class="feature-item">✓ Cookie expiration handling</div>
                </div>
            </section>
            
            <section style="margin-top: 40px; background: #e7f3ff; padding: 20px; border-radius: 10px; border-left: 4px solid #1e3c72;">
                <h3 style="color: #1e3c72; margin-bottom: 10px;">📝 Demo Credentials</h3>
                <p style="color: #1e3c72; line-height: 1.8;">
                    <strong>Username:</strong> demo<br>
                    <strong>Password:</strong> demo123
                </p>
            </section>
            
            <a href="../index.html" class="back-link">← Back to Main Index</a>
        </main>
        
        <footer>
            <p>&copy; 2023 TechStore | Exercise 10 - Sessions & Cookies</p>
        </footer>
    </div>
</body>
</html>
