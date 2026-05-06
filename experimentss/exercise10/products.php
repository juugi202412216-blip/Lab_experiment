<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - TechStore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 TechStore</h1>
            <p>Browse Products</p>
        </header>
        
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="cart.php">Cart 
                <?php 
                session_start();
                if (isset($_SESSION['cart'])) {
                    echo '(' . count($_SESSION['cart']) . ')';
                }
                ?>
            </a>
            <a href="profile.php">Profile</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
        
        <main>
            <?php
            // Handle add to cart
            if (isset($_GET['add'])) {
                $product_id = intval($_GET['add']);
                
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]++;
                } else {
                    $_SESSION['cart'][$product_id] = 1;
                }
                
                echo '<div class="success">✓ Product added to cart! <a href="cart.php">View Cart</a></div>';
            }
            
            // Sample products
            $products = [
                1 => ['name' => 'Dell Inspiron 15', 'price' => 45000, 'icon' => '💻', 'category' => 'Laptops'],
                2 => ['name' => 'Samsung Galaxy A54', 'price' => 25000, 'icon' => '📱', 'category' => 'Smartphones'],
                3 => ['name' => 'Sony WH-1000XM4', 'price' => 5000, 'icon' => '🎧', 'category' => 'Audio'],
                4 => ['name' => 'Canon EOS 1500D', 'price' => 35000, 'icon' => '📷', 'category' => 'Cameras'],
                5 => ['name' => 'Apple Watch Series 8', 'price' => 40000, 'icon' => '⌚', 'category' => 'Wearables'],
                6 => ['name' => 'Logitech MX Master 3', 'price' => 8000, 'icon' => '🖱️', 'category' => 'Accessories']
            ];
            ?>
            
            <div class="hero-section">
                <h2>Product Catalog</h2>
                <p>Add products to your cart using sessions</p>
            </div>
            
            <div class="products-grid">
                <?php foreach ($products as $id => $product): ?>
                    <div class="product-card">
                        <div class="product-image"><?php echo $product['icon']; ?></div>
                        <div class="product-body">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p class="product-category"><?php echo htmlspecialchars($product['category']); ?></p>
                            <div class="product-price">₹<?php echo number_format($product['price'], 2); ?></div>
                            <a href="products.php?add=<?php echo $id; ?>" class="btn">Add to Cart</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <section style="margin-top: 40px; background: #e7f3ff; padding: 20px; border-radius: 10px;">
                <h3 style="color: #1e3c72; margin-bottom: 10px;">🛍️ Shopping Cart Demo</h3>
                <p style="color: #1e3c72; line-height: 1.8;">
                    Click "Add to Cart" to add products. The cart state is maintained using PHP sessions,
                    allowing you to navigate between pages without losing your cart items.
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
