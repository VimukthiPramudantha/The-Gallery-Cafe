<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id'])) {
    die("Admin ID not found in session.");
}

$admin_id =  $_SESSION['user_id'];

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
    <link rel="shortcut icon" href="../images/Logo.png" type="image/x-icon">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../CSS/profile.css">
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
