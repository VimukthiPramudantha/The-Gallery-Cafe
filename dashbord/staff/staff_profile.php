<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection settings
include('../../dataBaseConnection.php');

// Fetch user details
$user_id = $_SESSION['user_id'];

$sql = "SELECT username, firstname, lastname FROM users WHERE id = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $firstname, $lastname);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Profile</title>
    <link rel="stylesheet" href="staff_profile.css">
</head>
<body>
    
    <div class="container">
        <aside>
        <h2>Staff Dashboard</h2>
            <ul>
                <li><a href="./staff_dashbord.php" >Dashboard</a></li>
                <li><a href="./staff_profile.php" class="active">Profile</a></li>
                <li><a href="./view_reservations.php">View Reservations</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </aside>
        <main>
            <div class="profile-container">
                <h1>My Profile</h1>
                <form action="update-profile.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="current-password">Current Password:</label>
                        <input type="password" id="current-password" name="current-password">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input type="password" id="new-password" name="new-password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <input type="password" id="confirm-password" name="confirm-password">
                    </div>
                    <button type="submit" class="save-button">Save Changes</button>
                </form>
                <?php if (isset($error) && !empty($error)): ?>
                    <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </div>
        </main>
    </div>
                    
</body>
</html>
