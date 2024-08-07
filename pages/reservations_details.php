<?php
session_start();

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

// Initialize variables
$name = $contact_number = $email = $occasion = $special_request = $new_table_id = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $occasion = isset($_POST['occasion']) ? $_POST['occasion'] : null;
    $special_request = isset($_POST['special_request']) ? $_POST['special_request'] : null;
    $new_table_id = $_POST['table_id']; // Add this line to get the table ID from the form
    $userid = $_SESSION['user_id'];

    // Prepare the SQL statement
    $sql = "INSERT INTO reservation_details (name, contact_number, email, occasion, special_request, user_id, table_id)
            VALUES ('$name', '$contact_number', '$email', '$occasion', '$special_request', '$userid', '$new_table_id')"; // Add new_table_id

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Reservation successful!');
                window.location.href = './reservations.php'; // Change this to your actual redirect URL
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>The Gallery Cafe - Reservations</title>
    <link rel="stylesheet" href="../CSS/reservations.css" />
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
            <img src="../img/Details page.png" id="wallpepar" />
            <div id="input">
                <div id="in">
                    <div id="border">
                        <h2>Your Details</h2>
                        <form action="" method="POST">
                            <input type="text" name="name" placeholder="Name" class="box" required />
                            <input type="text" name="contact_number" placeholder="Contact Number" class="box" required />
                            <input type="email" name="email" placeholder="Email" required class="box" />
                            <select name="occasion" class="box">
                                <option label="Occasion ( Optional )" disabled selected>Occasion</option>
                                <option value="birthday">Birthday</option>
                                <option value="anniversary">Anniversary</option>
                                <option value="date">Date</option>
                                <option value="special_occasion">Special Occasion</option>
                                <option value="business_meal">Business Meal</option>
                            </select>
                            <input type="text" name="special_request" placeholder="Special Request (Optional)" class="box" />
                            <select name="table_id" class="box" required>
                                <option label="Select Table" disabled selected>Select Table</option>
                                <!-- Populate the dropdown with available tables from the database -->
                                <?php
                                // Fetch tables from the database
                                $tables_sql = "SELECT table_id, num_of_people, date, time FROM find_table";
                                $tables_result = mysqli_query($conn, $tables_sql);

                                if (mysqli_num_rows($tables_result) > 0) {
                                    while ($table = mysqli_fetch_assoc($tables_result)) {
                                        echo '<option value="' . $table['table_id'] . '">Table for ' . $table['num_of_people'] . ' on ' . $table['date'] . ' at ' . $table['time'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <br />
                            <button id="next" type="submit">Submit</button>
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
