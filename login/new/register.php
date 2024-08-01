<?php
// Start the session
session_start();

include("../../dataBaseConnection.php");

// Initialize variables for form data and error messages
$firstName = $lastName = $username = $email = $password = "";
$firstName_err = $lastName_err = $username_err = $email_err = $password_err = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    if (empty(trim($_POST['firstName']))) {
        $firstName_err = "First Name is required.";
    } else {
        $firstName = $conn->real_escape_string(trim($_POST['firstName']));
    }

    if (empty(trim($_POST['lastName']))) {
        $lastName_err = "Last Name is required.";
    } else {
        $lastName = $conn->real_escape_string(trim($_POST['lastName']));
    }

    if (empty(trim($_POST['username']))) {
        $username_err = "Username is required.";
    } else {
        $username = $conn->real_escape_string(trim($_POST['username']));
    }

    if (empty(trim($_POST['email']))) {
        $email_err = "Email is required.";
    } else {
        $email = $conn->real_escape_string(trim($_POST['email']));
    }

    if (empty(trim($_POST['password']))) {
        $password_err = "Password is required.";
    } else {
        $password = trim($_POST['password']);
    }

    // Check for existing username or email
    if (empty($firstName_err) && empty($lastName_err) && empty($username_err) && empty($email_err) && empty($password_err)) {
        $check_sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $message = "Username or email already exists!";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert the new user into the database
            $sql = "INSERT INTO users (firstName, lastName, username, password, email, role)
                    VALUES ('$firstName', '$lastName', '$username', '$hashed_password', '$email', 'customer')";

            if ($conn->query($sql) === TRUE) {
                // Redirect to login page
                header("Location: ../login.php");
                exit();
            } else {
                $message = "Something went wrong. Please try again later.";
            }
        }

        // Close the connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="./loging.css">
</head>
<body>
    <h2>Register</h2>
    <?php if (!empty($message)) { echo '<div style="color: red;">' . $message . '</div>'; } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <input type="text" name="firstName" placeholder="First Name" id="firstName" value="<?php echo htmlspecialchars($firstName); ?>" required>
            <span style="color: red;"><?php echo $firstName_err; ?></span><br>
        </div>
        <div>
            <input type="text" name="lastName" placeholder="Last Name" id="lastName" value="<?php echo htmlspecialchars($lastName); ?>" required>
            <span style="color: red;"><?php echo $lastName_err; ?></span><br>
        </div>
        <div>
            <input type="text" name="username" placeholder="Username" id="username" value="<?php echo htmlspecialchars($username); ?>" required>
            <span style="color: red;"><?php echo $username_err; ?></span><br>
        </div>
        <div>
            <input type="text" name="email" placeholder="Email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <span style="color: red;"><?php echo $email_err; ?></span><br>
        </div>
        <div>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <span style="color: red;"><?php echo $password_err; ?></span><br><br>
        </div>
        <div>
            <input type="submit" value="Register">
        </div>
    </form>
</body>
</html>
