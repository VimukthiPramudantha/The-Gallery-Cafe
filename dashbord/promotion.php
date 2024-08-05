<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle add/edit promotion
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "UPDATE promotions SET name='$name', description='$description', status='$status', image='$image' WHERE id=$id";
    } else {
        $sql = "INSERT INTO promotions (name, description, status, image) VALUES ('$name', '$description', '$status', '$image')";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle delete promotion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM promotions WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all promotions
$sql = "SELECT * FROM promotions";
$result = $conn->query($sql);

$promotions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $promotions[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Promotions</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">Admin Dashboard</div>
        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Customers</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>
        <div class="user-profile">Admin | Logout</div>
    </header>
    <div class="container">
        <aside>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#" class="active">Promotions</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Customers</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </aside>
        <main>
            <div class="main-header">
                <h1>Promotions</h1>
                <button class="add-btn" onclick="document.getElementById('promotionForm').style.display='block'">Add New Promotion</button>
            </div>
            <section class="promotions-list">
                <?php foreach ($promotions as $promotion): ?>
                    <div class="promotion-card">
                        <h2><?php echo $promotion['name']; ?></h2>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($promotion['image']); ?>" alt="Promotion Image" class="promotion-image">
                        <p><?php echo $promotion['description']; ?></p>
                        <a href="?edit=<?php echo $promotion['id']; ?>" class="edit-btn">Edit</a>
                        <a href="?delete=<?php echo $promotion['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                        <span class="status <?php echo strtolower($promotion['status']); ?>"><?php echo $promotion['status']; ?></span>
                    </div>
                <?php endforeach; ?>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
        <nav>
            <ul>
                <li><a href="#">Help</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </footer>
    <!-- Promotion Form Modal -->
    <div id="promotionForm" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('promotionForm').style.display='none'">&times;</span>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo isset($_GET['edit']) ? $_GET['edit'] : ''; ?>">
                <label for="name">Promotion Name:</label>
                <input type="text" id="name" name="name" required value="<?php echo isset($promotion['name']) ? $promotion['name'] : ''; ?>">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?php echo isset($promotion['description']) ? $promotion['description'] : ''; ?></textarea>
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Active" <?php echo isset($promotion['status']) && $promotion['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Expired" <?php echo isset($promotion['status']) && $promotion['status'] == 'Expired' ? 'selected' : ''; ?>>Expired</option>
                </select>
                <label for="image">Promotion Image:</label>
                <input type="file" id="image" name="image" <?php echo isset($_GET['edit']) ? '' : 'required'; ?>>
                <button type="submit">Save Promotion</button>
            </form>
        </div>
    </div>
</body>
</html>
