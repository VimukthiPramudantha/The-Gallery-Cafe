<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $item_description = mysqli_real_escape_string($conn, $_POST['item_description']);
    $item_price = mysqli_real_escape_string($conn, $_POST['item_price']);
    $item_category = mysqli_real_escape_string($conn, $_POST['item_category']);

    // Handle file upload
    $item_image = '';
    if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['item_image']['tmp_name'];
        $file_name = $_FILES['item_image']['name'];
        $file_size = $_FILES['item_image']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($file_ext, $allowed_exts)) {
            $new_file_name = uniqid('', true) . '.' . $file_ext;
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $upload_file = $upload_dir . $new_file_name;
            if (move_uploaded_file($file_tmp, $upload_file)) {
                $item_image = $new_file_name;
            } else {
                echo "<p>Error uploading image.</p>";
                exit;
            }
        } else {
            echo "<p>Invalid file type.</p>";
            exit;
        }
    }

    // Prepare SQL query
    $sql = "INSERT INTO menu_item (name, description, price, category_name, image) 
            VALUES ('$item_name', '$item_description', '$item_price', '$item_category', '$item_image')";

    if (mysqli_query($conn, $sql)) {
        echo "<p>New menu item added successfully.</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="add_menu.css">
</head>
<body>
    <header>
        <div class="logo">Admin Dashboard</div>
        <nav>
            <ul>
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="view-reservations.html">View Reservations</a></li>
                <li><a href="add-menu-item.php" class="active">Add Menu Item</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside>
            <ul>
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="view-reservations.html">View Reservations</a></li>
                <li><a href="add-menu-item.php" class="active">Add Menu Item</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>
        <main>
            <div class="add-menu-container">
                <h1>Add New Menu Item</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="item-name">Item Name:</label>
                    <input type="text" id="item-name" name="item_name" required>

                    <label for="item-description">Description:</label>
                    <textarea id="item-description" name="item_description" rows="4" required></textarea>

                    <label for="item-price">Price:</label>
                    <input type="number" id="item-price" name="item_price" step="0.01" required>

                    <label for="item-category">Category:</label>
                    <select id="item-category" name="item_category" required>
                        <option value="">Select Category</option>
                        <option value="coffee">Coffee</option>
                        <option value="pastries">Pastries</option>
                        <option value="cold-beverages">Cold Beverages</option>
                        <option value="sandwiches-wraps">Sandwiches & Wraps</option>
                        <option value="sri-lankan">Sri Lankan</option>
                        <option value="chinese">Chinese</option>
                    </select>

                    <label for="item-image">Upload Image:</label>
                    <input type="file" id="item-image" name="item_image" accept="image/*">

                    <button type="submit" class="submit-btn">Add Item</button>
                </form>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </footer>
</body>
</html>
