<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_dashboard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch admin profile details (assuming there's only one admin for simplicity)
$sql = "SELECT * FROM admin_profile WHERE id=1"; // Update the query based on your database schema
$result = $conn->query($sql);

$profile = [];
if ($result->num_rows > 0) {
    $profile = $result->fetch_assoc();
}

$conn->close();
?>

<div class="profile-details">
    <img src="uploads/<?php echo $profile['profile_pic']; ?>" alt="Profile Picture">
    <h2><?php echo $profile['username']; ?></h2>
    <p>Full Name: <?php echo $profile['full_name']; ?></p>
</div>


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
                <li><a href="profile.html" class="active">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside>
            <ul>
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="promotions.html">Promotions</a></li>
                <li><a href="profile.html" class="active">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>
        <main>
            <div class="profile-header">
                <h1>Profile</h1>
            </div>
            <section class="profile-details">
                <?php include 'profile.php'; ?>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </footer>
</body>
</html>
