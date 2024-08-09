<?php
session_start();
include("../dataBaseConnection.php");

$sql = "SELECT * FROM promotions";
$result = mysqli_query($conn,$sql);

?>


<html>
  <head>
    <title>The Gallery Cafe - Specials</title>
    <link rel="stylesheet" href="../CSS/specials.css" />
    <link rel="shortcut icon" href="../images/Logo.png" type="image/x-icon">
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
      
      <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='inside'>";
                echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' class='imgAll' >";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "</div>";
            }
            ?>
        
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