<?php
session_start();
include('../dataBaseConnection.php'); // Include your database connection

// Initialize variables
$total_items = 0;
$total_price = 0;

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view the cart.");
}

$user_id = $_SESSION['user_id'];

// Retrieve cart data from database
$sql = "SELECT mi.id AS item_id, mi.name, mi.price, ci.quantity, ci.item_name
        FROM cart ci
        JOIN menu_item mi ON ci.item_name = mi.name
        WHERE ci.user_id = $user_id"; // Directly use the variable in the SQL query

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn)); // Error handling
}

$cart_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../CSS/styles.css" />
    <link rel="stylesheet" href="../CSS/navbar.css">
</head>
<body>
    <header>
        <?php include('./navbar.php'); ?>
        <div id="hAbout">
            <h1>Cart</h1>
        </div>
    </header>
    <div class="cart-container">
        <h1>Menu Cart</h1>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <?php if (empty($cart_items)): ?>
                <tr>
                    <td colspan="5">Your cart is empty.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    <td>
                    <form action="remove_from_cart.php" method="post">
                    <button class="remove" data-id="<?php echo htmlspecialchars($item['item_id']); ?>">Remove</button></td>

                    </form> 
                </tr>
                <?php
                $total_items += $item['quantity'];
                $total_price += $item['price'] * $item['quantity'];
                endforeach;
                ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="cart-summary">
            <h2>Cart Summary</h2>
            <p>Total Items: <span id="total-items"><?php echo htmlspecialchars($total_items); ?></span></p>
            <p>Total Price: $<span id="total-price"><?php echo number_format($total_price, 2); ?></span></p>
            <button id="checkout">Proceed to Checkout</button>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
