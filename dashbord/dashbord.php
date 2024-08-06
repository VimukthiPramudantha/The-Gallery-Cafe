<?php
session_start();

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

// Fetch user count
$user_count_sql = "SELECT COUNT(*) as user_count FROM users";
$user_count_result = mysqli_query($conn, $user_count_sql);
$user_count_row = mysqli_fetch_assoc($user_count_result);
$user_count = $user_count_row['user_count'];

// Fetch reservation count
$reservation_count_sql = "SELECT COUNT(*) as reservation_count FROM reservation_details";
$reservation_count_result = mysqli_query($conn, $reservation_count_sql);
$reservation_count_row = mysqli_fetch_assoc($reservation_count_result);
$reservation_count = $reservation_count_row['reservation_count'];

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./dashbord.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <h2>Admin Dashboard </h2>
            <ul>
                <li><a href="./profile.php">Profile</a></li>
                <li><a href="./add_user.php">Users</a></li>
                <li><a href="./add_menu.php">Manage Menu</a></li>
                <li><a href="./view_reservations.php">Reservations</a></li>
                <li><a href="./promotion.php">Promotions</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header>
                <h1>Welcome, Admin </h1>
                <div class="header-actions">
                    <input type="search" placeholder="Search...">
                    <a href="./staff/logout.php"><button>Logout</button></a>
                </div>
            </header>
            <section class="content">
                <div class="card">
                    <h3>Users</h3>
                    <p>Number of users: <?php echo $user_count;?></p>
                </div>
              
                <div class="card">
                    <h3>Reservations</h3>
                    <p>Number of reservations: <?php echo $reservation_count; ?></p>
                </div>
            </section>
        </div>
    </div>
    <script src="./script.js"></script>
</body>
</html>
