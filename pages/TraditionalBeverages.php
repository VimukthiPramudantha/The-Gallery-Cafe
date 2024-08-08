<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>The Gallery Cafe - Menu</title>
    <link rel="stylesheet" href="../CSS/TraditionalBeverages.css" />
    <link rel="stylesheet" href="../navbar.css">
</head>
<body>
    <header>
        <?php include('./navbar.php') ?>
        <div id="hAbout">
            <h1>Traditional Beverages</h1>
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

                // Retrieve menu data for Traditional Beverages
                $sql = "SELECT id, name, description, price, image FROM menu_item WHERE category_name = 'Traditional Beverages' AND menu_id = 1";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='dis'>";
                        echo "<div>";
                        echo "<h2 class='h2'>" . htmlspecialchars($row["name"]) . "</h2>";

                        // Check if image data is present
                        if ($row['image']) {
                            echo '<img src="./img/' . htmlspecialchars($row['image']) . '" alt="" class="image" />';
                        }

                        // Form for adding item to cart
                        echo "<form action='add_to_cart.php' method='POST'>";
                        echo "<input type='hidden' name='item_id' value='" . htmlspecialchars($row['id']) . "'>";
                        echo "<input type='hidden' name='item_name' value='" . htmlspecialchars($row['name']) . "'>";
                        echo "<input type='hidden' name='price' value='" . htmlspecialchars($row['price']) . "'>";
                        echo "<button type='submit' class='add'>Add To Cart</button>";
                        echo "</form>";

                        echo "<div>";
                        echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
                        echo "<p><strong>Price: </strong>" . number_format($row["price"], 2) . "</p>"; // Display price with 2 decimal places
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No items found.";
                }

                mysqli_close($conn);
                ?>
            </section>
        </div>
    </main>
</body>
</html>
