<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_id = $_POST['reservation_id'];
    $date = $_POST['reservation_date'];
    $time = $_POST['Time'];
    $guests = $_POST['guests'];

  
    $reservation_id = intval($reservation_id);
    $date = mysqli_real_escape_string($conn, $date);
    $time = mysqli_real_escape_string($conn, $time);
    $guests = intval($guests);

   
    $sql = "UPDATE reservation_details SET date='$date', time='$time', guests='$guests' WHERE id=$reservation_id AND user_id=$user_id";

    if (mysqli_query($conn, $sql)) {
        $success_message = "Reservation updated successfully.";
    } else {
        $error_message = "Error updating record: " . mysqli_error($conn);
    }
}

$reservation_id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM reservation_details WHERE id=$reservation_id AND user_id=$user_id";
$result = mysqli_query($conn, $sql);
$reservation = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/Logo.png" type="image/x-icon">
    <title>Edit Reservation</title>
    <link rel="stylesheet" href="../CSS/edit_reservation.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <h2>User Dashboard</h2>
            <ul>
            <li><a href="./Home.php">Home</a></li>
                <li><a href="user.php">Profile</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header>
                <h1>Edit Reservation</h1>
                <div class="header-actions">
                    <input type="search" placeholder="Search...">
                    <button>Logout</button>
                </div>
            </header>
            <section class="content-section">
                <?php if (isset($success_message)): ?>
                    <p class="success-message"><?php echo $success_message; ?></p>
                <?php endif; ?>
                <?php if (isset($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <form action="edit_reservation.php?id=<?php echo $reservation_id; ?>" method="POST">
                    <div class="form-group">
                        <label for="reservation-date">Date:</label>
                        <input type="date" id="reservation-date" name="reservation_date" value="<?php echo $reservation['date']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Time:</label>
                        <select name="Time" class="box" required>
                            <option value="06:00" <?php if ($reservation['time'] == "06:00") echo 'selected'; ?>>6:00 am</option>
                            <option value="06:30" <?php if ($reservation['time'] == "06:30") echo 'selected'; ?>>6:30 am</option>
                            <option value="07:00" <?php if ($reservation['time'] == "07:00") echo 'selected'; ?>>7:00 am</option>
                            <option value="07:30" <?php if ($reservation['time'] == "07:30") echo 'selected'; ?>>7:30 am</option>
                            <option value="08:00" <?php if ($reservation['time'] == "08:00") echo 'selected'; ?>>8:00 am</option>
                            <option value="08:30" <?php if ($reservation['time'] == "08:30") echo 'selected'; ?>>8:30 am</option>
                            <option value="09:00" <?php if ($reservation['time'] == "09:00") echo 'selected'; ?>>9:00 am</option>
                            <option value="09:30" <?php if ($reservation['time'] == "09:30") echo 'selected'; ?>>9:30 am</option>
                            <option value="10:00" <?php if ($reservation['time'] == "10:00") echo 'selected'; ?>>10:00 am</option>
                            <option value="10:30" <?php if ($reservation['time'] == "10:30") echo 'selected'; ?>>10:30 am</option>
                            <option value="11:00" <?php if ($reservation['time'] == "11:00") echo 'selected'; ?>>11:00 am</option>
                            <option value="11:30" <?php if ($reservation['time'] == "11:30") echo 'selected'; ?>>11:30 am</option>
                            <option value="12:00" <?php if ($reservation['time'] == "12:00") echo 'selected'; ?>>12:00 pm</option>
                            <option value="12:30" <?php if ($reservation['time'] == "12:30") echo 'selected'; ?>>12:30 pm</option>
                            <option value="13:00" <?php if ($reservation['time'] == "13:00") echo 'selected'; ?>>1:00 pm</option>
                            <option value="13:30" <?php if ($reservation['time'] == "13:30") echo 'selected'; ?>>1:30 pm</option>
                            <option value="14:00" <?php if ($reservation['time'] == "14:00") echo 'selected'; ?>>2:00 pm</option>
                            <option value="14:30" <?php if ($reservation['time'] == "14:30") echo 'selected'; ?>>2:30 pm</option>
                            <option value="15:00" <?php if ($reservation['time'] == "15:00") echo 'selected'; ?>>3:00 pm</option>
                            <option value="15:30" <?php if ($reservation['time'] == "15:30") echo 'selected'; ?>>3:30 pm</option>
                            <option value="16:00" <?php if ($reservation['time'] == "16:00") echo 'selected'; ?>>4:00 pm</option>
                            <option value="16:30" <?php if ($reservation['time'] == "16:30") echo 'selected'; ?>>4:30 pm</option>
                            <option value="17:00" <?php if ($reservation['time'] == "17:00") echo 'selected'; ?>>5:00 pm</option>
                            <option value="17:30" <?php if ($reservation['time'] == "17:30") echo 'selected'; ?>>5:30 pm</option>
                            <option value="18:00" <?php if ($reservation['time'] == "18:00") echo 'selected'; ?>>6:00 pm</option>
                            <option value="18:30" <?php if ($reservation['time'] == "18:30") echo 'selected'; ?>>6:30 pm</option>
                            <option value="19:00" <?php if ($reservation['time'] == "19:00") echo 'selected'; ?>>7:00 pm</option>
                            <option value="19:30" <?php if ($reservation['time'] == "19:30") echo 'selected'; ?>>7:30 pm</option>
                            <option value="20:00" <?php if ($reservation['time'] == "20:00") echo 'selected'; ?>>8:00 pm</option>
                            <option value="20:30" <?php if ($reservation['time'] == "20:30") echo 'selected'; ?>>8:30 pm</option>
                            <option value="21:00" <?php if ($reservation['time'] == "21:00") echo 'selected'; ?>>9:00 pm</option>
                            <option value="21:30" <?php if ($reservation['time'] == "21:30") echo 'selected'; ?>>9:30 pm</option>
                            <option value="22:00" <?php if ($reservation['time'] == "22:00") echo 'selected'; ?>>10:00 pm</option>
                            <option value="22:30" <?php if ($reservation['time'] == "22:30") echo 'selected'; ?>>10:30 pm</option>
                            <option value="23:00" <?php if ($reservation['time'] == "23:00") echo 'selected'; ?>>11:00 pm</option>
                            <option value="23:30" <?php if ($reservation['time'] == "23:30") echo 'selected'; ?>>11:30 pm</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guests">Number of Guests:</label>
                        <input type="number" id="guests" name="guests" min="1" value="<?php echo $reservation['guests']; ?>" required>
                    </div>
                    <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
                    <div class="form-group">
                        <button type="submit">Update Reservation</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
