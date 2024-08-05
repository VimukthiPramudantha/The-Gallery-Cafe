<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection settings
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userId = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $currentPassword = $_POST['current-password'];
        $newPassword = $_POST['new-password'];
        $confirmPassword = $_POST['confirm-password'];
        $profilePicPath = "";

        // Handle profile picture upload
        if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] == 0) {
            $allowed = array('jpg', 'jpeg', 'png');
            $filename = $_FILES['profile-pic']['name'];
            $filetype = pathinfo($filename, PATHINFO_EXTENSION);

            if (in_array($filetype, $allowed)) {
                $newFilename = uniqid() . "." . $filetype;
                $profilePicPath = "uploads/" . $newFilename;
                move_uploaded_file($_FILES['profile-pic']['tmp_name'], $profilePicPath);
            } else {
                $error = "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
            }
        }

        // Update name
        $stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname WHERE id = :id");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        // Update profile picture
        if ($profilePicPath) {
            $stmt = $conn->prepare("UPDATE users SET profile_pic = :profile_pic WHERE id = :id");
            $stmt->bindParam(':profile_pic', $profilePicPath);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        }

        // Check and update password
        if (!empty($currentPassword) && !empty($newPassword) && !empty($confirmPassword)) {
            // Fetch current password from the database
            $stmt = $conn->prepare("SELECT password FROM users WHERE id = :id");
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($currentPassword, $user['password'])) {
                if ($newPassword === $confirmPassword) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                    $stmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");
                    $stmt->bindParam(':password', $hashedPassword);
                    $stmt->bindParam(':id', $userId);
                    $stmt->execute();
                } else {
                    $error = "New passwords do not match.";
                }
            } else {
                $error = "Current password is incorrect.";
            }
        }

        if (!isset($error)) {
            header('Location: staff-profile.php');
            exit();
        }
    }

    // Fetch user details
    $stmt = $conn->prepare("SELECT username, firstname, lastname, profile_pic FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
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
    <header>
        <div class="logo">Staff Dashboard</div>
        <nav>
            <ul>
                <li><a href="staff-dashboard.php">Dashboard</a></li>
                <li><a href="staff-profile.php" class="active">Profile</a></li>
                <li><a href="view-reservations.php">View Reservations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside>
            <ul>
                <li><a href="staff-dashboard.php">Dashboard</a></li>
                <li><a href="staff-profile.php" class="active">Profile</a></li>
                <li><a href="view-reservations.php">View Reservations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>
        <main>
            <div class="profile-container">
                <h1>My Profile</h1>
                <div class="profile-pic">
                    <img src="<?php echo $user['profile_pic'] ?: 'default-pic.jpg'; ?>" alt="Profile Picture">
                    <form action="update-profile.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="profile-pic">
                        <button type="submit" class="upload-button">Upload New Picture</button>
                    </form>
                </div>
                <form action="update-profile.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>">
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
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Staff Dashboard. All rights reserved.</p>
    </footer>
</body>
</html>
