<?php
session_start();
// Database connection
include("../dataBaseConnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare the SQL statement
    $sql = "SELECT id, firstName, lastName, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Bind result variables
    mysqli_stmt_bind_result($stmt, $id, $firstName, $lastName, $username, $hashed_password);

    // Fetch the results
    if (mysqli_stmt_fetch($stmt)) {
        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Start the session and store user information
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;

            // Redirect to a logged-in page
            header("Location: .././index/Home.html");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that username.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>The Gallery Cafe - Login</title>
    <link rel="stylesheet" href="./login.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
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
                <br></br><p>Don't have an account? <a href="./new/register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
