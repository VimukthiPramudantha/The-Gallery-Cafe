<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $item_description = mysqli_real_escape_string($conn, $_POST['item_description']);
    $item_price = mysqli_real_escape_string($conn, $_POST['item_price']);
    $item_category = mysqli_real_escape_string($conn, $_POST['item_category']);
    $menu_id = mysqli_real_escape_string($conn, $_POST['menu_id']);


    if (!empty($_FILES['item_image']['tmp_name'])) {
        $image = $_FILES['item_image']['tmp_name'];
       $imgContent = addslashes(file_get_contents($image));
           
        }

    $sql = "INSERT INTO menu_item (name, description, price, category_name, image, menu_id) 
            VALUES ('$item_name', '$item_description', '$item_price', '$item_category', '$imgContent', '$menu_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New menu item added successfully.'); window.location.href='add_menu.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='add_menu.php';</script>";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/Logo.png" type="image/x-icon">
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="../CSS/add_menu.css">
</head>
<body>
    <div class="container">
        <aside>
            <h2>Admin Dashboard</h2>
            <ul>
                    <li><a href="./Home.php">Home</a></li>
                    <li><a href="./dashbord.php">Dashboard</a></li>
                    <li><a href="./profile.php">Profile</a></li>
                    <li><a href="./add_user.php">Users</a></li>
                    <li><a href="./add_menu.php">Manage Menu</a></li>
                    <li><a href="./manage_menu_items.php">Delete Menu Items</a></li>
                    <li><a href="./admin_view_reservations.php">Reservations</a></li>
                    <li><a href="./promotion.php">Promotions</a></li>
                    <li><a href="./view_feedback.php">Feedback</a></li>
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
                        <option value="Cold Beverages">Cold Beverages</option>
                        <option value="sandwiches-wraps">Sandwiches & Wraps</option>
                        <option value="Ceylon Tea">Ceylon tea</option>
                        <option value="Pastries and Breads">Pastries and Breads</option>

                        <option value="Main Dishes">Main Dishes</option>
                        <option value="Desserts">Desserts</option>
                        <option value="Traditional Beverages">Traditional Beverages</option>
                        <option value="Breakfast">Breakfast Items</option>
                        <option value="Main Dishes">Main Dishes</option>
                        
                    </select>

                    <label for="menu_id">Menu ID:</label>
                    <select id="menu_id" name="menu_id" required>
                        <option value="">Select Menu ID</option>
                        <option value="1">Favourite Dishes</option>
                        <option value="2">Sri Lankan Cafe Delights</option>
                        <option value="3">Chinese Cafe Favorites</option>
                    </select>

                    <label for="item-image">Upload Image:</label>
                    <input type="file" id="item-image" name="item_image" accept="image/*" required>

                    <button type="submit" class="submit-btn">Add Item</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
