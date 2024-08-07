<?php
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

// Handle add/edit promotion
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $sql = "UPDATE promotions SET name='$name', description='$description', status='$status', image='$image' WHERE id=$id";
    } else {
        $sql = "INSERT INTO promotions (name, description, status, image) VALUES ('$name', '$description', '$status', '$image')";
    }

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Handle delete promotion
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    $sql = "DELETE FROM promotions WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Fetch all promotions
$sql = "SELECT * FROM promotions";
$result = mysqli_query($conn, $sql);

$promotions = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $promotions[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Promotions</title>
    <link rel="stylesheet" href="../CSS/premotions.css">
</head>
<body>
    
    <div class="container">
        <aside>
        <h2>Admin Dashboard </h2>
        <ul>
                <li><a href="./dashbord.php">Dashboard</a></li>
                <li><a href="./profile.php">Profile</a></li>
                <li><a href="./add_user.php">Users</a></li>
                <li><a href="./add_menu.php">Manage Menu</a></li>
                <li><a href="./admin_view_reservations.php">Reservations</a></li>
                <li><a href="./view_feedback.php">Feedback</a></li>
                <li><a href="#">Promotions</a></li>
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
