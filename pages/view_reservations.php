<?php
// Database connection parameters
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

// Handle Confirm Action
if (isset($_POST['confirm'])) {
    $reservation_id = (int)$_POST['reservation_id'];
    $sql = "UPDATE reservations SET status = 'Confirmed' WHERE id = $reservation_id";
    if (mysqli_query($conn, $sql)) {
        echo "<p>Status updated to Confirmed.</p>";
    } else {
        echo "<p>Error updating status: " . mysqli_error($conn) . "</p>";
    }
}

// Handle Cancel Action
if (isset($_POST['cancel'])) {
    $reservation_id = (int)$_POST['reservation_id'];
    $sql = "UPDATE reservations SET status = 'Cancelled' WHERE id = $reservation_id";
    if (mysqli_query($conn, $sql)) {
        echo "<p>Reservation cancelled successfully.</p>";
    } else {
        echo "<p>Error cancelling reservation: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch all reservations with table details
$sql = "SELECT r.*, t.table_no, t.capacity
        FROM reservations r
        JOIN tables t ON r.table_id = t.id";
$result = mysqli_query($conn, $sql);

$reservations = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
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
    <title>View Reservations</title>
    <link rel="stylesheet" href="../CSS/view_reservations.css">
</head>
<body>
    <div class="container">
        <aside>
            <h2>Staff Dashboard</h2>
            <ul>
                <li><a href="./Home.php">Home</a></li>
                <li><a href="./staff_dashboard.php">Dashboard</a></li>
                <li><a href="./staff_profile.php">Profile</a></li>
                <li><a href="#" class="active">View Reservations</a></li>
                <li><a href="./logout.php">Logout</a></li>
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
                            <th>Date</th>
                            <th>Time</th>
                            <th>Guests</th>
                            <th>Table</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['name']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['email']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['reservation_date']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['reservation_time']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['num_of_people']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['table_no']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['status']); ?></td>
                            <td>
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                                    <button type="submit" name="confirm" class="confirm-button">Confirm</button>
                                </form>

                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                                    <button type="submit" name="cancel" class="cancel-button">Cancel</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
