<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include('../../../dataBaseConnection.php');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="staff_dashboard.css">
</head>
<body>
   
    <div class="container">
        <aside>
            <h2>Staff Dashboard</h2>
            <ul>
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="./staff_profile.php">Profile</a></li>
                <li><a href="./view_reservations.php">View Reservations</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </aside>
        <main>
            <div class="dashboard-content">
                <h1>Welcome to the Staff Dashboard</h1>
                <div class="dashboard-sections">
                    <div class="section">
                        <a href="./staff_profile.php">
                            <h2>Profile</h2>
                            <p>View and update your profile information</p>
                        </a>
                    </div>
                    <div class="section">
                        <a href="./view_reservations.php">
                            <h2>View Reservations</h2>
                            <p>Check all upcoming reservations</p>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
  
</body>
</html>

