<div class="topnav">
        <a href="./home.php" class="navbar" >Home</a>
        <a href="./menu.php" class="navbar">Menu</a>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a href="./pages/dashbord.php" class="navbar">Dashboard</a>
      <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'staff'): ?>
        <a href="./pages/staff/staff_dashbord.php" class="navbar">Dashboard</a>
      <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="./pages/user/user.php" class="navbar">profile</a>
      <?php endif  ?>
     
        <a href="./specials.php" class="navbar">Specials</a>
        <a href="./reservations.php" class="navbar">Reservations</a>
        <a href="./contact.php" class="navbar">Contact Us</a>
      </div>