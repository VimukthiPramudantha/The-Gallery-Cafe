<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login/login.php");
    exit();
}
include('../dataBaseConnection.php');

// Fetch user count
$user_count_sql = "SELECT COUNT(*) as user_count FROM users";
$user_count_result = mysqli_query($conn, $user_count_sql);
$user_count_row = mysqli_fetch_assoc($user_count_result);
$user_count = $user_count_row['user_count'];

// Fetch reservation count
$reservation_count_sql = "SELECT COUNT(*) as reservation_count FROM reservations";
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
    <link rel="stylesheet" href="../CSS/dashbord.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <h2>Admin Dashboard </h2>
            <ul>
            <li><a href="./Home.php">Home</a></li>
                <li><a href="./profile.php">Profile</a></li>
                <li><a href="./add_user.php">Users</a></li>
                <li><a href="./add_menu.php">Manage Menu</a></li>
                <li><a href="./admin_view_reservations.php">Reservations</a></li>
                <li><a href="./promotion.php">Promotions</a></li>
                <li><a href="./view_feedback.php">Feedback</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header>
                <h1>Welcome, Admin </h1>
                <div class="header-actions">
                    <input type="search" placeholder="Search...">
                    <a href="./logout.php"><button>Logout</button></a>
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
</body>
</html>
