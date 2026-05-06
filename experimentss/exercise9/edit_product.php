<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - TechStore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 TechStore Product Management</h1>
            <p>Edit Product</p>
        </header>
        
        <nav>
            <a href="index.php">Products</a>
            <a href="add_product.php">Add Product</a>
        </nav>
        
        <main>
            <?php
            require_once 'config.php';
            
            $errors = [];
            $success = false;
            $product = null;
            
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
            
            if (!$product) {
                header("Location: index.php");
                exit();
            }
            
            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = trim($_POST['name'] ?? '');
                $description = trim($_POST['description'] ?? '');
                $price = $_POST['price'] ?? '';
                $category = trim($_POST['category'] ?? '');
                $stock = $_POST['stock'] ?? '';
                $image_url = trim($_POST['image_url'] ?? '');
                
                // Validation
                if (empty($name)) {
                    $errors[] = "Product name is required";
                }
                
                if (empty($price) || !is_numeric($price) || $price < 0) {
                    $errors[] = "Valid price is required";
                }
                
                if (empty($category)) {
                    $errors[] = "Category is required";
                }
                
                if (empty($stock) || !is_numeric($stock) || $stock < 0) {
                    $errors[] = "Valid stock quantity is required";
                }
                
                // If no errors, update database
                if (empty($errors)) {
                    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, category=?, stock=?, image_url=? WHERE id=?");
                    $stmt->bind_param("ssdsssi", $name, $description, $price, $category, $stock, $image_url, $id);
                    
                    if ($stmt->execute()) {
                        $success = true;
                        // Refresh product data
                        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $product = $result->fetch_assoc();
                    } else {
                        $errors[] = "Error updating product: " . $conn->error;
                    }
                    
                    $stmt->close();
                }
            }
            
            $conn->close();
            ?>
            
            <div class="form-container">
                <h2>Edit Product</h2>
                
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
                        <strong>✓ Product Updated Successfully!</strong><br>
                        The product has been updated in the database.<br>
                        <a href="index.php">View all products</a>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
                    <div class="form-group">
                        <label for="name">Product Name *</label>
                        <input type="text" id="name" name="name" 
                               value="<?php echo htmlspecialchars($product['name']); ?>" 
                               placeholder="Enter product name">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Enter product description"><?php echo htmlspecialchars($product['description']); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price (₹) *</label>
                        <input type="number" id="price" name="price" step="0.01" min="0"
                               value="<?php echo htmlspecialchars($product['price']); ?>" 
                               placeholder="Enter price">
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select id="category" name="category">
                            <option value="">Select category</option>
                            <option value="Laptops" <?php echo ($product['category'] == 'Laptops') ? 'selected' : ''; ?>>Laptops</option>
                            <option value="Smartphones" <?php echo ($product['category'] == 'Smartphones') ? 'selected' : ''; ?>>Smartphones</option>
                            <option value="Audio" <?php echo ($product['category'] == 'Audio') ? 'selected' : ''; ?>>Audio</option>
                            <option value="Cameras" <?php echo ($product['category'] == 'Cameras') ? 'selected' : ''; ?>>Cameras</option>
                            <option value="Wearables" <?php echo ($product['category'] == 'Wearables') ? 'selected' : ''; ?>>Wearables</option>
                            <option value="Accessories" <?php echo ($product['category'] == 'Accessories') ? 'selected' : ''; ?>>Accessories</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="stock">Stock Quantity *</label>
                        <input type="number" id="stock" name="stock" min="0"
                               value="<?php echo htmlspecialchars($product['stock']); ?>" 
                               placeholder="Enter stock quantity">
                    </div>
                    
                    <div class="form-group">
                        <label for="image_url">Image (Emoji)</label>
                        <input type="text" id="image_url" name="image_url" 
                               value="<?php echo htmlspecialchars($product['image_url']); ?>" 
                               placeholder="Enter emoji (e.g., 💻, 📱, 🎧)">
                    </div>
                    
                    <button type="submit" class="btn">Update Product</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
            
            <a href="../index.html" class="back-link">← Back to Main Index</a>
        </main>
        
        <footer>
            <p>&copy; 2023 TechStore | Exercise 9 - PHP & MySQL</p>
        </footer>
    </div>
</body>
</html>
