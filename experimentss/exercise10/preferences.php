<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferences - TechStore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 TechStore</h1>
            <p>User Preferences</p>
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
            
            $success = '';
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $theme = $_POST['theme'] ?? 'default';
                $language = $_POST['language'] ?? 'english';
                $notifications = isset($_POST['notifications']) ? 'enabled' : 'disabled';
                
                // Set cookies for 30 days
                setcookie('user_theme', $theme, time() + (86400 * 30), "/");
                setcookie('user_language', $language, time() + (86400 * 30), "/");
                setcookie('user_notifications', $notifications, time() + (86400 * 30), "/");
                
                $success = 'Preferences saved successfully! Cookies will expire in 30 days.';
            }
            
            // Get current preferences from cookies
            $current_theme = $_COOKIE['user_theme'] ?? 'default';
            $current_language = $_COOKIE['user_language'] ?? 'english';
            $current_notifications = ($_COOKIE['user_notifications'] ?? 'disabled') === 'enabled';
            ?>
            
            <div class="form-container">
                <h2>User Preferences</h2>
                <p style="color: #666; margin-bottom: 20px;">
                    Set your preferences. They will be saved in cookies and remembered for 30 days.
                </p>
                
                <?php if ($success): ?>
                    <div class="success">✓ <?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="theme">Theme</label>
                        <select id="theme" name="theme">
                            <option value="default" <?php echo $current_theme === 'default' ? 'selected' : ''; ?>>Default</option>
                            <option value="dark" <?php echo $current_theme === 'dark' ? 'selected' : ''; ?>>Dark Mode</option>
                            <option value="light" <?php echo $current_theme === 'light' ? 'selected' : ''; ?>>Light Mode</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="language">Language</label>
                        <select id="language" name="language">
                            <option value="english" <?php echo $current_language === 'english' ? 'selected' : ''; ?>>English</option>
                            <option value="hindi" <?php echo $current_language === 'hindi' ? 'selected' : ''; ?>>Hindi</option>
                            <option value="spanish" <?php echo $current_language === 'spanish' ? 'selected' : ''; ?>>Spanish</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label style="display: flex; align-items: center; font-weight: normal;">
                            <input type="checkbox" name="notifications" style="width: auto; margin-right: 8px;" 
                                   <?php echo $current_notifications ? 'checked' : ''; ?>>
                            Enable email notifications
                        </label>
                    </div>
                    
                    <button type="submit" class="btn">Save Preferences</button>
                </form>
                
                <div style="margin-top: 30px; background: #fff3cd; padding: 15px; border-radius: 8px;">
                    <strong style="color: #856404;">Current Cookie Values:</strong><br>
                    <span style="color: #856404;">
                        Theme: <?php echo htmlspecialchars($current_theme); ?><br>
                        Language: <?php echo htmlspecialchars($current_language); ?><br>
                        Notifications: <?php echo $current_notifications ? 'Enabled' : 'Disabled'; ?>
                    </span>
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
