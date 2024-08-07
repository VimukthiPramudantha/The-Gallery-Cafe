<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Sanitize and validate input
    $num_of_people = mysqli_real_escape_string($conn, $_POST['People']);
    $date = mysqli_real_escape_string($conn, $_POST['Date']);
    $time = mysqli_real_escape_string($conn, $_POST['Time']);
    $table = mysqli_real_escape_string($conn, $_POST['table']);
    

    // Prepare and execute SQL statement
    $sql = "INSERT INTO find_table (num_of_people, date, time, table_id) VALUES ('$num_of_people', '$date', '$time',' $table')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
        window.location.href = 'reservations_details.php';
    </script>";    } else {
        echo "<script>showAlert('Error: " . mysqli_error($conn) . "', 'error');</script>";
    }

    // Close the connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe - Reservations</title>
    <link rel="stylesheet" href="../CSS/reservations.css">
    <script>
        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert ${type}`;
            alertDiv.textContent = message;
            document.body.insertBefore(alertDiv, document.body.firstChild);
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }
    </script>
</head>
<body>
    <header>
        <?php include('./navbar.php') ?>
        <div id="hAbout">
            <h1>Reservations</h1>
        </div>
    </header>
    <main>
        <h1 id="heading">Make a Reservation</h1>
        <div id="res">
            <img src="../img/back.png" id="wallpepar" />
            <div id="input">
                <div id="in">
                    <div id="border">
                        <h2>Find Table</h2>
                        <form action="reservations.php" method="post">
                            <select name="People" class="box" required>
                                <option value="2 people">2 People</option>
                                <option value="3 people">3 People</option>
                                <option value="4 people">4 People</option>
                                <option value="5 people">5 People</option>
                                <option value="6 people">6 People</option>
                            </select>
                            <input type="date" name="Date" class="box" required />

                            <select name="Time" class="box" required>
                                <!-- Time options -->
                                <option value="06:00">6:00 am</option>
                                <option value="06:30">6:30 am</option>
                                <option value="07:00">7:00 am</option>
                                <option value="07:30">7:30 am</option>
                                <option value="08:00">8:00 am</option>
                                <option value="08:30">8:30 am</option>
                                <option value="09:00">9:00 am</option>
                                <option value="09:30">9:30 am</option>
                                <option value="10:00">10:00 am</option>
                                <option value="10:30">10:30 am</option>
                                <option value="11:00">11:00 am</option>
                                <option value="11:30">11:30 am</option>
                                <option value="12:00">12:00 pm</option>
                                <option value="12:30">12:30 pm</option>
                                <option value="13:00">1:00 pm</option>
                                <option value="13:30">1:30 pm</option>
                                <option value="14:00">2:00 pm</option>
                                <option value="14:30">2:30 pm</option>
                                <option value="15:00">3:00 pm</option>
                                <option value="15:30">3:30 pm</option>
                                <option value="16:00">4:00 pm</option>
                                <option value="16:30">4:30 pm</option>
                                <option value="17:00">5:00 pm</option>
                                <option value="17:30">5:30 pm</option>
                                <option value="18:00">6:00 pm</option>
                                <option value="18:30">6:30 pm</option>
                                <option value="19:00">7:00 pm</option>
                                <option value="19:30">7:30 pm</option>
                                <option value="20:00">8:00 pm</option>
                                <option value="20:30">8:30 pm</option>
                                <option value="21:00">9:00 pm</option>
                                <option value="21:30">9:30 pm</option>
                                <option value="22:00">10:00 pm</option>
                                <option value="22:30">10:30 pm</option>
                                <option value="23:00">11:00 pm</option>
                                <option value="23:30">11:30 pm</option>
                            </select>
                            <select name="table" class="box" required>
                                <!-- Time options -->
                                <option value="1">Table 01</option>
                                <option value="2">Table 02</option>
                                <option value="3">Table 03</option>
                                <option value="4">Table 04</option>
                                <option value="5">Table 05</option>
                                <option value="6">Table 06</option>
                            </select>
                            <br />
                            <button type="submit" id="next">Next</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <hr width="100%" size="2" noshade color="orange" style="margin-top: 10%" />
    <div id="contact">
        <table>
            <tr>
                <th><img src="../img/address.png" alt="" /></th>
                <th><img src="../img/Email.png" alt="" /></th>
                <th><img src="../img/phone.png" alt="" /></th>
                <th><img src="../img/icons8-time-machine-100.png" alt="" /></th>
            </tr>
            <tr>
                <td><h2>Address</h2></td>
                <td><h2>Email</h2></td>
                <td><h2>Phone</h2></td>
                <td><h2>Opening Time</h2></td>
            </tr>
            <tr>
                <td style="color: silver">
                    The Gallery Café<br />
                    123 Colombo Street<br />
                    Galle, Southern Province<br />
                    Sri Lanka 80000
                </td>
                <td style="font-size: 20px">
                    <a href="#Email">info@thegallerycafe.lk</a>
                </td>
                <td style="font-size: 20px; color: silver">+94 77 123 4567</td>
                <td style="font-size: 20px; color: silver">
                    Opening Time: 8:00 AM<br />
                    Closing Time: 10:00 PM
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
