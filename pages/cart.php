<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../CSS/styles.css" />
  </head>
  <body>
    <header>
        <?php include('./navbar.php') ?>
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
          <!-- Items will be dynamically inserted here -->
        </tbody>
      </table>
      <div class="cart-summary">
        <h2>Cart Summary</h2>
        <p>Total Items: <span id="total-items">0</span></p>
        <p>Total Price: $<span id="total-price">0.00</span></p>
        <button id="checkout">Proceed to Checkout</button>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
