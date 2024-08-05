<!DOCTYPE html>
<html>
<head>
    <title>The Gallery Cafe - Menu</title>
    <link rel="stylesheet" href="./MainDishes.css" />
</head>
<body>
    <header>
        <div class="topnav">
            <a href="../index/Home.html" class="navbar">Home</a>
            <a href="../menu.html" class="navbar" style="color: orange">Menu</a>
            <a href="../Specials page/specials.html" class="navbar">Specials</a>
            <a href="../reservations page/reservations.html" class="navbar">Reservations</a>
            <a href="../Contact Us page/contact.html" class="navbar">Contact Us</a>
        </div>
        <div id="hAbout">
            <h1>Main Dishes</h1>
        </div>
    </header>
    <main>
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
                $sql = "SELECT name, description, price, image FROM menu_item WHERE category_name = 'Main Dishes' && menu_id='2'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='dis'>";
                        echo "<div>";
                        echo "<h2 class='h2'>" . $row["name"] . "</h2>";
                        if ($row['image']) {
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="" class="image" />';
                        }
                        echo "<button class='add'>Add To Cart</button>";
                        echo "<div>";
                        echo "<p>" . $row["description"] . "</p>";
                        echo "<p><strong>Price: </strong>" . number_format($row["price"], 2) . "</p>"; // Display price with 2 decimal places
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
</body>
</html>
