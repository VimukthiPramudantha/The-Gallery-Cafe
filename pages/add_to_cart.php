<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";


$conn = mysqli_connect($servername, $username, $password, $dbname);

$user_id = ($_SESSION['user_id']);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = 1; 

  
    $sql = "SELECT * FROM cart WHERE item_name = '$item_name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        
        $sql = "UPDATE cart SET quantity = quantity + 1 WHERE item_name = '$item_name'";
    } else {
        
        $sql = "INSERT INTO cart (item_name, quantity, price,user_id) VALUES ('$item_name', '$quantity', '$price', '$user_id')";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Item added to cart successfully.'); window.location.href='menu.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='menu.php';</script>";
    }

    mysqli_close($conn);
}
?>
