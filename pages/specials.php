<?php
session_start();
?>

<html>
  <head>
    <title>The Gallery Cafe - Specials</title>
    <link rel="stylesheet" href="../CSS/specials.css" />
  </head>
  <body>
    <header>
      <?php include('./navbar.php')
      ?>
      <div id="hAbout">
        <h1>Specials</h1>
      </div>
    </header>
    <main>
      <p id="dis">
        Discover our carefully curated specials, designed to offer a unique and
        delightful experience. Each dish is crafted with premium ingredients,
        ensuring both quality and flavor. From gourmet classics to innovative
        creations, our specials menu is a testament to our commitment to
        culinary excellence. Treat yourself to something extraordinary with our
        exclusive selections that change regularly to bring you the best of
        seasonal and fresh offerings.
      </p>
      <div class="img">
        <div class="inside">
          <h2>Truffle Mushroom Risotto</h2>
          <img src="../img/Truffle Mushroom Risotto.png" alt="" class="imgAll" />

          <p>
            Creamy risotto made with aromatic truffle oil and sautéed mushrooms,
            topped with Parmesan cheese.
          </p>
        </div>
        <div class="inside">
          <h2>Avocado Toast</h2>
          <img src="../img/Avocado Toast.png" alt="" class="imgAll" />

          <p>
            Slices of toasted bread topped with mashed avocado, cherry tomatoes,
            feta cheese, and a drizzle of olive oil.
          </p>
        </div>
      </div>
      <div class="img">
        <div class="inside">
          <h2>Smoked Salmon Bagel</h2>
          <img src="../img/Smoked Salmon Bagel.png" alt="" class="imgAll" />

          <p>
            A toasted bagel spread with cream cheese, topped with smoked salmon,
            capers, red onions, and fresh dill.
          </p>
        </div>
        <div class="inside">
          <h2>Quinoa Salad</h2>
          <img src="../img/Quinoa Salad.png" alt="" class="imgAll" />

          <p style="text-align: center">
            A refreshing salad with quinoa, mixed greens, roasted vegetables,
            feta cheese, and a lemon vinaigrette.
          </p>
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