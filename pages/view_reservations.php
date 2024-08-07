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
    $sql = "UPDATE reservation_details SET status = 'Confirmed' WHERE id = $reservation_id";
    if (mysqli_query($conn, $sql)) {
        echo "<p>Status updated to Confirmed.</p>";
    } else {
        echo "<p>Error updating status: " . mysqli_error($conn) . "</p>";
    }
}

// Handle Delete Action
if (isset($_POST['delete'])) {
    $reservation_id = (int)$_POST['reservation_id'];
    $sql = "DELETE FROM reservation_details WHERE id = $reservation_id";
    if (mysqli_query($conn, $sql)) {
        echo "<p>Reservation deleted successfully.</p>";
    } else {
        echo "<p>Error deleting reservation: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch all reservations with table details
$sql = "SELECT r.*, t.num_of_people, t.date AS table_date, t.time AS table_time
        FROM reservation_details r
        JOIN find_table t ON r.table_id = t.id";
$result = mysqli_query($conn, $sql);

$reservations = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reservations[] = $row;
    }
}

// Close the connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations</title>
    <link rel="stylesheet" href="../CSS/view_reservations.css">
</head>
<body>
    <div class="container">
        <aside>
        <h2>Staff Dashboard</h2>
            <ul>
                <li><a href="./staff_dashbord.php" >Dashboard</a></li>
                <li><a href="./staff_profile.php" >Profile</a></li>
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
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['name']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['email']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['table_date']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['table_time']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['num_of_people']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['status']); ?></td>
                            <td>
                            <form method="POST" action="confirm-reservation.php" style="display:inline;">
    <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
    <button type="submit" name="confirm" class="confirm-button">Confirm</button>
</form>

<form method="POST" action="cancel-reservation.php" style="display:inline;">
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
