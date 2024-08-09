<?php
session_start();
include('../dataBaseConnection.php'); // Include your database connection


if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to perform this action.");
}

if (isset($_POST['item_id'])) {
    $item_id = intval($_POST['item_id']);
    $user_id = $_SESSION['user_id'];

   
    $sql = "DELETE FROM cart WHERE item_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $item_id, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Item removed successfully.";
    } else {
        echo "Error removing item: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}


mysqli_close($conn);
?>
