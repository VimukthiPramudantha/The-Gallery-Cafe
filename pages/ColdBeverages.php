<!DOCTYPE html>
<html>
<head>
    <title>The Gallery Cafe - Menu</title>
    <link rel="stylesheet" href="../CSS/ColdBeverages.css" />
</head>
<body>
    <header>
        <?php include('../navbar.php') ?> 
        <div id="hAbout">
            <h1>Cold Beverages</h1>
        </div>
    </header>
    <main>
        <h1 style="color: white">Coffees</h1>
        <div id="items">
            <section id="selection">
                <?php
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

                // Retrieve menu data
                $sql = "SELECT name, description, price, image FROM menu_item WHERE category_name = 'Cold Beverages'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='dis'>";
                        echo "<div>";
                        echo "<h2 class='h2'>" . htmlspecialchars($row["name"]) . "</h2>";
                        if (!empty($row['image'])) {
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="" class="image" />';
                        }
                        echo "<button class='add'>Add To Cart</button>";
                        echo "<div>";
                        echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "0 results";
                }

                mysqli_close($conn);
                ?>
            </section>
        </div>
    </main>

    <hr width="100%" size="2" noshade color="orange" style="margin-top: 80px; margin-bottom: 50px" />
    <div id="contact">
        <table>
            <tr>
                <th><img src="../img/address.png" alt="" /></th>
                <th><img src="../img/Email.png" alt="" /></th>
                <th><img src="../img/phone.png" alt="" /></th>
                <th><img src="../img/icons8-time-machine-100.png" alt="" /></th>
            </tr>
            <tr style="text-align: center">
                <td><h2>Address</h2></td>
                <td><h2>Email</h2></td>
                <td><h2>Phone</h2></td>
                <td><h2>Opening Time</h2></td>
            </tr>
            <tr style="text-align: center">
                <td>
                    The Gallery Cafe<br />
                    123 Colombo Street<br />
                    Galle, Southern Province<br />
                    Sri Lanka 80000
                </td>
                <td style="font-size: 20px">
                    <a href="mailto:info@thegallerycafe.lk">info@thegallerycafe.lk</a>
                </td>
                <td style="font-size: 20px">+94 77 123 4567</td>
                <td style="font-size: 20px">
                    Opening Time: 8:00 AM<br />
                    Closing Time: 10:00 PM
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
