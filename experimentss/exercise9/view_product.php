<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product - TechStore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 TechStore Product Management</h1>
            <p>Product Details</p>
        </header>
        
        <nav>
            <a href="index.php">Products</a>
            <a href="add_product.php">Add Product</a>
        </nav>
        
        <main>
            <?php
            require_once 'config.php';
            
            // Get product ID
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            
            if ($id <= 0) {
                header("Location: index.php");
                exit();
            }
            
            // Fetch product details
            $conn = getDBConnection();
            $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $stmt->close();
            $conn->close();
            
            if (!$product) {
                header("Location: index.php");
                exit();
            }
            ?>
            
            <div class="product-detail-container">
                <div class="product-detail-image">
                    <?php echo htmlspecialchars($product['image_url']); ?>
                </div>
                
                <div class="product-detail-info">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p class="product-category">Category: <?php echo htmlspecialchars($product['category']); ?></p>
                    
                    <div class="product-price-large">₹<?php echo number_format($product['price'], 2); ?></div>
                    
                    <div class="product-stock-status">
                        <?php if ($product['stock'] > 0): ?>
                            <span class="in-stock">✓ In Stock (<?php echo $product['stock']; ?> available)</span>
                        <?php else: ?>
                            <span class="out-of-stock">✗ Out of Stock</span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="product-description-full">
                        <h3>Description</h3>
                        <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                    </div>
                    
                    <div class="product-meta">
                        <p><strong>Product ID:</strong> #<?php echo $product['id']; ?></p>
                        <p><strong>Added:</strong> <?php echo date('F j, Y', strtotime($product['created_at'])); ?></p>
                        <p><strong>Last Updated:</strong> <?php echo date('F j, Y', strtotime($product['updated_at'])); ?></p>
                    </div>
                    
                    <div class="product-actions-large">
                        <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn">Edit Product</a>
                        <a href="index.php" class="btn btn-secondary">Back to Products</a>
                        <a href="index.php?delete=<?php echo $product['id']; ?>" 
                           class="btn btn-delete" 
                           onclick="return confirm('Are you sure you want to delete this product?')">Delete Product</a>
                    </div>
                </div>
            </div>
            
            <a href="../index.html" class="back-link">← Back to Main Index</a>
        </main>
        
        <footer>
            <p>&copy; 2023 TechStore | Exercise 9 - PHP & MySQL</p>
        </footer>
    </div>
</body>
</html>
