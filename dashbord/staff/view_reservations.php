<?php
// Database connection settings
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle confirm action
    if (isset($_POST['confirm'])) {
        $id = $_POST['reservation_id'];
        $stmt = $conn->prepare("UPDATE reservations SET status = 'Confirmed' WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Handle delete action
    if (isset($_POST['delete'])) {
        $id = $_POST['reservation_id'];
        $stmt = $conn->prepare("DELETE FROM reservations WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Fetch all reservations
    $stmt = $conn->prepare("SELECT * FROM reservations");
    $stmt->execute();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>View Reservations</title>
    <link rel="stylesheet" href="view_reservations.css">
</head>
<body>
    <header>
        <div class="logo">Staff Dashboard</div>
        <nav>
            <ul>
                <li><a href="staff-dashboard.php">Dashboard</a></li>
                <li><a href="staff-profile.php">Profile</a></li>
                <li><a href="view-reservations.php" class="active">View Reservations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside>
            <ul>
                <li><a href="staff-dashboard.php">Dashboard</a></li>
                <li><a href="staff-profile.php">Profile</a></li>
                <li><a href="view-reservations.php" class="active">View Reservations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>
        <main>
            <div class="reservations-container">
                <h1>View Reservations</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['name']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['email']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['phone']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['date']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['time']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['guests']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['status']); ?></td>
                            <td>
                                <form method="POST" action="view-reservations.php" style="display:inline;">
                                    <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                                    <button type="submit" name="confirm" class="confirm-button">Confirm</button>
                                </form>
                                <form method="POST" action="view-reservations.php" style="display:inline;">
                                    <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                                    <button type="submit" name="delete" class="delete-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Staff Dashboard. All rights reserved.</p>
    </footer>
</body>
</html>
