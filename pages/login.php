<?php
session_start();

include("../dataBaseConnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

   
    $sql = "SELECT id, firstName, lastName, username, role, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);

    
    mysqli_stmt_execute($stmt);

   
    mysqli_stmt_bind_result($stmt, $id, $firstName, $lastName, $username, $role, $hashed_password );

   
    if (mysqli_stmt_fetch($stmt)) {
        
        if (password_verify($password, $hashed_password)) {
           
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['role'] = $role;

            
            header("Location: ./Home.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that username.";
    }

  
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>The Gallery Cafe - Login</title>
    <link rel="stylesheet" href="../CSS/login.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../images/Logo.png" type="image/x-icon">
    
</head>
<body>
    <div class="homeButton">
        <a href="./Home.php"><button onclick="window.location.href='../index/Home.html'" class="btn">Home</button></a>
    </div>
    <div class="wrapper">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1>Login</h1>
            <?php if (!empty($error)) { echo '<div style="color: red;">' . $error . '</div>'; } ?>
            <div class="inputBox">
                <input type="text" name="username" placeholder="User Name" required />
                <i class='bx bxs-user'></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" placeholder="Password" required />
                <i class='bx bxs-lock-open-alt'></i>
            </div>
            <div class="rememberFogot">
                <label><input type="checkbox" /> Remember Me</label>
                <a href="#">Forgot Password</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="registerlink">
                <br></br><p>Don't have an account? <a href="./register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
