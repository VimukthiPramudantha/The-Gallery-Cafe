<?php
session_start();
include('../../../dataBaseConnection.php');

// Check if user is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'customer') {
    header("Location: .././login/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user profile details
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);

$profile = [];
if (mysqli_num_rows($result) > 0) {
    $profile = mysqli_fetch_assoc($result);
}

// Fetch user reservations with the new foreign key
$sql = "SELECT r.*, t.num_of_people, t.date AS table_date, t.time AS table_time
        FROM reservation_details r
        JOIN find_table t ON r.table_id = t.table_id
        WHERE r.user_id = $user_id";
$reservations = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <h2>User Dashboard</h2>
            <ul>
                <li><a href="#profile" class="active">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header>
                <h1>Welcome, <?php echo htmlspecialchars($profile['username']); ?></h1>
                <div class="header-actions">
                    <input type="search" placeholder="Search...">
                    <button>Logout</button>
                </div>
            </header>
            <section id="profile" class="content-section">
                <h2>Profile</h2>
                <div class="profile-details">
                    <p>Username: <span><?php echo htmlspecialchars($profile['username']); ?></span></p>
                    <p>Full Name: <span><?php echo htmlspecialchars($profile['firstName'] . ' ' . htmlspecialchars($profile['lastName'])); ?></span></p>
                </div>
            </section>
            <section id="reservations" class="content-section">
                <h2>Reservations</h2>
                <div class="reservation-list">
                    <?php if (mysqli_num_rows($reservations) > 0) { ?>
                        <?php while ($reservation = mysqli_fetch_assoc($reservations)) { ?>
                            <div class="reservation-card">
                                <h3>Reservation #<?php echo htmlspecialchars($reservation['id']); ?></h3>
                                <p>Date: <?php echo htmlspecialchars($reservation['table_date']); ?></p>
                                <p>Time: <?php echo htmlspecialchars($reservation['table_time']); ?></p>
                                <p>Guests: <?php echo htmlspecialchars($reservation['num_of_people']); ?></p>
                                <a href="edit_reservation.php?id=<?php echo htmlspecialchars($reservation['id']); ?>"></a>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p>No reservations found.</p>
                    <?php } ?>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
