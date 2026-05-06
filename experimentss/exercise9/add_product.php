<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - TechStore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 TechStore Product Management</h1>
            <p>Add New Product</p>
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
                
                // If no errors, insert into database
                if (empty($errors)) {
                    $conn = getDBConnection();
                    $stmt = $conn->prepare("INSERT INTO products (name, description, price, category, stock, image_url) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssdsss", $name, $description, $price, $category, $stock, $image_url);
                    
                    if ($stmt->execute()) {
                        $success = true;
                    } else {
                        $errors[] = "Error adding product: " . $conn->error;
                    }
                    
                    $stmt->close();
                    $conn->close();
                }
            }
            ?>
            
            <div class="form-container">
                <h2>Add New Product</h2>
                
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
                        <strong>✓ Product Added Successfully!</strong><br>
                        The product has been added to the database.<br>
                        <a href="index.php">View all products</a>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="name">Product Name *</label>
                        <input type="text" id="name" name="name" 
                               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" 
                               placeholder="Enter product name">
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Enter product description"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price (₹) *</label>
                        <input type="number" id="price" name="price" step="0.01" min="0"
                               value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>" 
                               placeholder="Enter price">
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select id="category" name="category">
                            <option value="">Select category</option>
                            <option value="Laptops" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Laptops') ? 'selected' : ''; ?>>Laptops</option>
                            <option value="Smartphones" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Smartphones') ? 'selected' : ''; ?>>Smartphones</option>
                            <option value="Audio" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Audio') ? 'selected' : ''; ?>>Audio</option>
                            <option value="Cameras" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Cameras') ? 'selected' : ''; ?>>Cameras</option>
                            <option value="Wearables" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Wearables') ? 'selected' : ''; ?>>Wearables</option>
                            <option value="Accessories" <?php echo (isset($_POST['category']) && $_POST['category'] == 'Accessories') ? 'selected' : ''; ?>>Accessories</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="stock">Stock Quantity *</label>
                        <input type="number" id="stock" name="stock" min="0"
                               value="<?php echo isset($_POST['stock']) ? htmlspecialchars($_POST['stock']) : ''; ?>" 
                               placeholder="Enter stock quantity">
                    </div>
                    
                    <div class="form-group">
                        <label for="image_url">Image (Emoji)</label>
                        <input type="text" id="image_url" name="image_url" 
                               value="<?php echo isset($_POST['image_url']) ? htmlspecialchars($_POST['image_url']) : ''; ?>" 
                               placeholder="Enter emoji (e.g., 💻, 📱, 🎧)">
                    </div>
                    
                    <button type="submit" class="btn">Add Product</button>
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
