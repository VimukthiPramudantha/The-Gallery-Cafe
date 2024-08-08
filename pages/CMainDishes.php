<?php  
session_start();
?>

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
$sql_items = "SELECT id, name, description, price, image FROM menu_item WHERE category_name = 'Main Dishes' && menu_id =4";
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
    <link rel="stylesheet" href="../CSS/MainDishes.css" />
</head>
<body>
    <header>
        <?php include('./navbar.php') ?> 
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
                        <?php if (!empty($item['image'])): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image']); ?>" alt="" class="image" />
                        <?php endif; ?>
                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                            <input type="hidden" name="item_name" value="<?php echo htmlspecialchars($item['name']); ?>">
                            <input type="hidden" name="price" value="<?php echo htmlspecialchars($item['price']); ?>">
                            <button type="submit" class="add">Add To Cart</button>
                        </form>
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
