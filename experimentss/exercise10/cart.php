<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - TechStore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 TechStore</h1>
            <p>Shopping Cart</p>
        </header>
        
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="cart.php">Cart</a>
            <a href="profile.php">Profile</a>
            <?php 
            session_start();
            if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
        
        <main>
            <?php
            // Sample products (same as products.php)
            $products = [
                1 => ['name' => 'Dell Inspiron 15', 'price' => 45000, 'icon' => '💻'],
                2 => ['name' => 'Samsung Galaxy A54', 'price' => 25000, 'icon' => '📱'],
                3 => ['name' => 'Sony WH-1000XM4', 'price' => 5000, 'icon' => '🎧'],
                4 => ['name' => 'Canon EOS 1500D', 'price' => 35000, 'icon' => '📷'],
                5 => ['name' => 'Apple Watch Series 8', 'price' => 40000, 'icon' => '⌚'],
                6 => ['name' => 'Logitech MX Master 3', 'price' => 8000, 'icon' => '🖱️']
            ];
            
            // Handle remove from cart
            if (isset($_GET['remove'])) {
                $product_id = intval($_GET['remove']);
                if (isset($_SESSION['cart'][$product_id])) {
                    unset($_SESSION['cart'][$product_id]);
                    echo '<div class="success">✓ Product removed from cart!</div>';
                }
            }
            
            // Handle clear cart
            if (isset($_GET['clear'])) {
                $_SESSION['cart'] = [];
                echo '<div class="success">✓ Cart cleared!</div>';
            }
            
            // Calculate total
            $total = 0;
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $id => $quantity) {
                    if (isset($products[$id])) {
                        $total += $products[$id]['price'] * $quantity;
                    }
                }
            }
            ?>
            
            <h2>Your Shopping Cart</h2>
            
            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
                            <?php if (isset($products[$id])): ?>
                                <tr>
                                    <td>
                                        <span style="font-size: 30px; margin-right: 10px;"><?php echo $products[$id]['icon']; ?></span>
                                        <strong><?php echo htmlspecialchars($products[$id]['name']); ?></strong>
                                    </td>
                                    <td>₹<?php echo number_format($products[$id]['price'], 2); ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><strong>₹<?php echo number_format($products[$id]['price'] * $quantity, 2); ?></strong></td>
                                    <td>
                                        <a href="cart.php?remove=<?php echo $id; ?>" class="btn btn-delete">Remove</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr style="background: #f8f9fa; font-weight: bold;">
                            <td colspan="3" style="text-align: right;">Grand Total:</td>
                            <td colspan="2" style="font-size: 1.3em; color: #1e3c72;">₹<?php echo number_format($total, 2); ?></td>
                        </tr>
                    </tbody>
                </table>
                
                <div style="margin-top: 30px; display: flex; gap: 15px;">
                    <a href="products.php" class="btn btn-secondary">Continue Shopping</a>
                    <a href="cart.php?clear=1" class="btn btn-delete" onclick="return confirm('Clear all items from cart?')">Clear Cart</a>
                    <button class="btn" onclick="alert('Checkout functionality would be implemented here!')">Proceed to Checkout</button>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <p style="font-size: 3em; margin-bottom: 20px;">🛒</p>
                    <h3>Your cart is empty</h3>
                    <p>Add some products to get started!</p>
                    <a href="products.php" class="btn">Browse Products</a>
                </div>
            <?php endif; ?>
            
            <section style="margin-top: 40px; background: #e7f3ff; padding: 20px; border-radius: 10px;">
                <h3 style="color: #1e3c72; margin-bottom: 10px;">🔄 Session State Demo</h3>
                <p style="color: #1e3c72; line-height: 1.8;">
                    Your cart items are stored in PHP session variables. Try navigating to different pages
                    and come back - your cart items will persist throughout your session!
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
