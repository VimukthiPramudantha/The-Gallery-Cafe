<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

   
   
        
        $sql = "INSERT INTO users (firstName, username, email, password, role) 
                VALUES ('$firstName', '$username', '$email', '$password', '$role')";
        if (mysqli_query($conn, $sql)) {
            echo "New user added successfully";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } 


$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

$users = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/Logo.png" type="image/x-icon">
    <title>Add User</title>
    <link rel="stylesheet" href="../CSS/add_user.css">
</head>
<body>
    <div class="container">
        <aside>
       <h2>Admin Dashboard</h2>
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
            <div class="form-container">
                <h1>Add New User</h1>
                <form action="" method="POST" enctype="multipart/form-data">
               
                <label for="firstName">Name:</label>
                <input type="text" id="firstName" name="firstName" required>
                    
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    
                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                    <option selected disabled>Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                    </select>
                    
                    <button type="submit">Add User</button>
                </form>
            </div>

            <div class="user-list">
                <h2>Existing Users</h2>
                <?php if (!empty($users)): ?>
                    <ul>
                        <?php foreach ($users as $user): ?>
                            <li>
                            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['firstName']); ?></p>

                                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                                <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No users found.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
                    
</body>
</html>
