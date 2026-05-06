<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 9 - PHP & MySQL Product Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 TechStore Product Management</h1>
            <p>PHP & MySQL Integration - Exercise 9</p>
        </header>
        
        <nav>
            <a href="index.php">Products</a>
            <a href="add_product.php">Add Product</a>
        </nav>
        
        <main>
            <div class="hero-section">
                <h2>Product Catalog</h2>
                <p>Browse and manage products using PHP and MySQL</p>
            </div>
            
            <?php
            require_once 'config.php';
            
            // Handle delete request
            if (isset($_GET['delete'])) {
                $id = intval($_GET['delete']);
                $conn = getDBConnection();
                $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    echo '<div class="success">✓ Product deleted successfully!</div>';
                } else {
                    echo '<div class="error">❌ Error deleting product: ' . $conn->error . '</div>';
                }
                
                $stmt->close();
                $conn->close();
            }
            
            // Fetch all products
            $conn = getDBConnection();
            $result = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
            ?>
            
            <div class="products-grid">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($product = $result->fetch_assoc()): ?>
                        <div class="product-card">
                            <div class="product-image"><?php echo htmlspecialchars($product['image_url']); ?></div>
                            <div class="product-body">
                                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                                <p class="product-category"><?php echo htmlspecialchars($product['category']); ?></p>
                                <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                                <div class="product-price">₹<?php echo number_format($product['price'], 2); ?></div>
                                <p class="product-stock">
                                    <?php if ($product['stock'] > 0): ?>
                                        <span style="color: #28a745;">✓ In Stock (<?php echo $product['stock']; ?>)</span>
                                    <?php else: ?>
                                        <span style="color: #dc3545;">✗ Out of Stock</span>
                                    <?php endif; ?>
                                </p>
                                <div class="product-actions">
                                    <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-edit">Edit</a>
                                    <a href="view_product.php?id=<?php echo $product['id']; ?>" class="btn btn-view">View</a>
                                    <a href="index.php?delete=<?php echo $product['id']; ?>" 
                                       class="btn btn-delete" 
                                       onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <p>No products found. <a href="add_product.php">Add your first product</a></p>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php
            $conn->close();
            ?>
            
            <a href="../index.html" class="back-link">← Back to Main Index</a>
        </main>
        
        <footer>
            <p>&copy; 2023 TechStore | Exercise 9 - PHP & MySQL</p>
        </footer>
    </div>
</body>
</html>
