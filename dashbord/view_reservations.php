<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Confirm Action
if (isset($_POST['confirm'])) {
    $reservation_id = $_POST['reservation_id'];
    $sql = "UPDATE reservation_details SET status = 'Confirmed' WHERE id = $reservation_id";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Status updated to Confirmed.</p>";
    } else {
        echo "<p>Error updating status: " . $conn->error . "</p>";
    }
}

// Handle Delete Action
if (isset($_POST['delete'])) {
    $reservation_id = $_POST['reservation_id'];
    $sql = "DELETE FROM reservation_details WHERE id = $reservation_id";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Reservation deleted successfully.</p>";
    } else {
        echo "<p>Error deleting reservation: " . $conn->error . "</p>";
    }
}

// Fetch all reservations with table details
$sql = "SELECT r.*, t.num_of_people, t.date AS table_date, t.time AS table_time
        FROM reservation_details r
        JOIN find_table t ON r.table_id = t.id";
$result = $conn->query($sql);

$reservations = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

$conn->close();
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
        <div class="logo">Admin Dashboard</div>
        <nav>
            <ul>
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="promotions.html">Promotions</a></li>
                <li><a href="profile.html">Profile</a></li>
                <li><a href="view-reservations.php" class="active">View Reservations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside>
            <ul>
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="promotions.html">Promotions</a></li>
                <li><a href="profile.html">Profile</a></li>
                <li><a href="view-reservations.php" class="active">View Reservations</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>
        <main>
            <div class="reservations-container">
                <h1>View Reservations</h1>
                <div class="status-bar">
                    <span>Status: <strong>All Reservations</strong></span>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Occasion</th>
                            <th>Special Request</th>
                            <th>Number of Guests</th>
                            <th>Table Date</th>
                            <th>Table Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reservations)): ?>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($reservation['id']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['name']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['contact_number']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['email']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['occasion']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['special_request']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['num_of_people']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['table_date']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['table_time']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['status']); ?></td>
                                    <td>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                                            <button type="submit" name="confirm" class="confirm-btn">Confirm</button>
                                        </form>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                                            <button type="submit" name="delete" class="delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="11">No reservations found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </footer>
</body>
</html>
