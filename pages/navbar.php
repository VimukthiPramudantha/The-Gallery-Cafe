<div class="topnav">

<?php if ( !isset($_SESSION['role']) ): ?>
        <a href="./login.php" class="navbar login-button">
          Login <i class="fas fa-user-lock"></i>
        </a>
        <?php endif  ?>
        <?php if ( isset($_SESSION['role']) ): ?>
          <a href="/" class="navbar login-button">
          <?php echo($_SESSION['username']) ?><i class="fas fa-user-lock"></i>
          </a>
        <?php endif  ?>

        <div class="nav-items">

        <a href="./home.php" class="navbar" >Home</a>
        <a href="./menu.php" class="navbar">Menu</a>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <a href="./dashbord.php" class="navbar">Dashboard</a>
      <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'staff'): ?>
        <a href="./staff_dashbord.php" class="navbar">Dashboard</a>
      <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
        <a href="./user.php" class="navbar">profile</a>
      <?php endif  ?>
     
        <a href="./specials.php" class="navbar">Specials</a>
        <a href="./reservations.php" class="navbar">Reservations</a>
        <a href="./contact.php" class="navbar">Contact Us</a>
      </div>
      </div>