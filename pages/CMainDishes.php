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

// Retrieve main dishes data
$sql_items = "SELECT * FROM menu_item WHERE category_name = 'Main Dishes'";
$result_items = mysqli_query($conn, $sql_items);

// Check if there are results
if (!$result_items) {
    die("Query failed: " . mysqli_error($conn));
}

$items = [];
while ($row = mysqli_fetch_assoc($result_items)) {
    $items[] = $row;
}

// Close connection
mysqli_close($conn);
?>

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
          <?php foreach ($items as $item): ?>
          <div class="dis">
            <div>
              <h2 class="h2"><?php echo htmlspecialchars($item['name']); ?></h2>
              <?php if ($item['image']): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image']); ?>" alt="" class="image" />
              <?php endif; ?>
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
