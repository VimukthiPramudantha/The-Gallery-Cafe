<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['cancel'])) {
    $reservation_id = (int)$_POST['reservation_id'];
    $sql = "UPDATE reservation_details SET status = 'canceled' WHERE id = $reservation_id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
        alert('Reservation canceled successfully');
        window.location.href = 'view_reservations.php';
      </script>";
} else {
echo "<script>
        alert('Error canceling reservation: " . mysqli_error($conn) . "');
        window.location.href = 'view_reservations.php';
      </script>";
}
}


mysqli_close($conn);
?>
