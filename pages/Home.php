<?php
session_start();

include('../dataBaseConnection.php');



?>

<html>
  <head>
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="../CSS/home.css" />
    <link rel="shortcut icon" href="../images/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../CSS/navbar.css">

  </head>
  <body>
    <div class="background"></div>
    <header>
<!--       
      <div class="login">
        <div class="topnav">
          <a href="../login page/login.html" class="navbar">
            Login <i class="fas fa-user-lock"></i>
          </a>
      </div> -->
<?php
      include('./navbar.php'); ?>
    </header>
    <main>
      <div id="insidebody">
        <div id="welcome">
          <p>Welcome to The Gallery Cafe</p>
        </div>
        <div id="caption">
          <h2 id="captionh2">
            Where art meets aroma! Join us at The Gallery Cafe for a delicious
            escape.
          </h2>
        </div>
        <div id="about"><a href="../pages/About.php"><p>About us</p></a></div>
      </div>
    </main>
  </body>
</html>
