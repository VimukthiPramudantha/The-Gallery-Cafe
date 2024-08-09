<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['confirm'])) {
    $reservation_id = (int)$_POST['reservation_id'];
    $sql = "UPDATE reservations SET status = 'Confirmed' WHERE id = $reservation_id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Status updated to Confirmed.'); window.location.href='admin_view_reservations.php';</script>";
    } else {
        echo "<script>alert('Error updating status: " . mysqli_error($conn) . "');</script>";
    }
}


if (isset($_POST['delete'])) {
    $reservation_id = (int)$_POST['reservation_id'];
    $sql = "DELETE FROM reservations WHERE id = $reservation_id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Reservation deleted successfully.'); window.location.href='admin_view_reservations.php';</script>";
    } else {
        echo "<script>alert('Error deleting reservation: " . mysqli_error($conn) . "');</script>";
    }
}


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
    <title>View Reservations</title>
    <link rel="shortcut icon" href="../images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/admin_view_reservations.css">
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
                            <th>Table No</th>
                            <th>Table Capacity</th>
                            <th>Date</th>
                            <th>Time</th>
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
                                    <td><?php echo htmlspecialchars($reservation['table_no']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['capacity']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['reservation_date']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['reservation_time']); ?></td>
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
                                <td colspan="13">No reservations found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
