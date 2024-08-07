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
$menu_id = 4; // Adjust to the correct menu_id based on your data

// Fetch menu items
$sql_items = "SELECT * FROM menu_item WHERE menu_id = $menu_id";
$result_items = mysqli_query($conn, $sql_items);

// Check if there are results
if (!$result_items) {
    die("Query failed: " . mysqli_error($conn));
}

$items = [];
while ($row = mysqli_fetch_assoc($result_items)) {
    // Encode the image data to base64
    $row['image'] = base64_encode($row['image']);
    $items[] = $row;
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>The Gallery Cafe - Menu</title>
    <link rel="stylesheet" href="./BreakfastItems.css" />
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
            <h1>Breakfast Items</h1>
        </div>
    </header>
    <main>
        <div id="items">
            <section id="selection">
                <?php foreach ($items as $item): ?>
                <div class="dis">
                    <div>
                        <h2 class="h2"><?php echo htmlspecialchars($item['name']); ?></h2>
                        <img src="data:image/png;base64,<?php echo $item['image']; ?>" alt="" class="image" />
                        <button class="add">Add To Cart</button>
                        <div>
                            <p><?php echo htmlspecialchars($item['description']); ?></p>
                            <p><strong>Price:</strong> $<?php echo number_format($item['price'], 2); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </section>
        </div>
    </main>
</body>
</html>
