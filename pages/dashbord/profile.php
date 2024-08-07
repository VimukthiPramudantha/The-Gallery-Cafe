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
        <div class="logo">
           <h2> Admin Profile</h2></div>
        <nav>
            
        </nav>
    </header>
    <div class="container">
        <aside>
        <h2 style="color: orange;">Admin Dashboard</h2>
            <ul>
                <li><a href="./dashbord.php">Dashboard</a></li>
                <li><a href="">Profile</a></li>
                <li><a href="./add_user.php">Users</a></li>
                <li><a href="./add_menu.php">Manage Menu</a></li>
                <li><a href="./view_reservations.php">Reservations</a></li>
                <li><a href="./promotion.php">Promotions</a></li>
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
    
</body>
</html>
