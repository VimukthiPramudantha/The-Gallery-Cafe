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
        header("Location: user_dashboard.php#reservations");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
