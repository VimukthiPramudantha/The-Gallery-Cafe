<?php
session_start();

// Database connection details
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

// Check if admin ID is set in the session
if (!isset($_SESSION['user_id'])) {
    die("Admin ID not found in session.");
}

$admin_id =  $_SESSION['user_id'];

// Fetch admin profile details
$sql = "SELECT * FROM users WHERE id=$admin_id";
$result = mysqli_query($conn, $sql);

$profile = [];
if (mysqli_num_rows($result) > 0) {
    $profile = mysqli_fetch_assoc($result);
} else {
    die("No profile found for admin ID: " . $admin_id);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <header>
        <div class="logo">Admin Dashboard</div>
        <nav>
            <ul>
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="promotions.html">Promotions</a></li>
                <li><a href="profile.php" class="active">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside>
            <ul>
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="promotions.html">Promotions</a></li>
                <li><a href="profile.php" class="active">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>
        <main>
            <div class="profile-header">
                <h1>Profile</h1>
            </div>
            <section class="profile-details">
                <div class="profile-details">
                  
                    <h2><?php echo htmlspecialchars($profile['username']); ?></h2>
                    <p>Full Name: <?php echo htmlspecialchars($profile['firstName']); ?></p>
                </div>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </footer>
</body>
</html>
