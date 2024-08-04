<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gallery_cafe";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO feedback (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='contact.php';</script>";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe - Contact Us</title>
    <link rel="stylesheet" href="./contact.css" />
</head>
<body>
    <header>
        <div class="topnav">
            <a href="../index/Home.html" class="navbar">Home</a>
            <a href="../menu page/menu.html" class="navbar">Menu</a>
            <a href="../Specials page/specials.html" class="navbar">Specials</a>
            <a href="../reservations page/reservations.php" class="navbar">Reservations</a>
            <a href="#contact" class="navbar" style="color: orange">Contact Us</a>
        </div>
        <div id="hAbout">
            <h1>Contact Us</h1>
        </div>
    </header>
    <main>
        <div id="all">
            <div id="map">
                <img src="./img/Map.png" alt="" id="img" />
                <h4>The Gallery Cafe 123 Colombo Street Galle, Southern Province Sri Lanka 80000</h4>
                <p class="con">Email: <a href="mailto:info@thegallerycafe.lk">info@thegallerycafe.lk</a></p>
                <p class="con">Phone: <a href="tel:+94771234567">+94 77 123 4567</a></p>
            </div>
            <div id="img2">
                <p id="googleM">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.59139894953398!2d79.86363434165837!3d6.835033100654043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25b17ff7e8a3d%3A0xd4c129187fcd9dbd!2sTilly&#39;s%20Beach%20Hotel!5e0!3m2!1sen!2slk!4v1721888698953!5m2!1sen!2slk"
                        width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </p>
            </div>
        </div>
        <div id="feedback">
            <h2>Send Your Message To Us</h2>
            <form method="post" action="contact.php">
                <div id="msgHead">
                    <input type="text" name="name" placeholder="Your Name" class="insi" required />
                    <input type="email" name="email" placeholder="Your E-mail" class="insi" required />
                </div>
                <input type="text" name="subject" placeholder="Subject" class="inside full-width" />
                <textarea name="message" placeholder="Message" class="inside message-box"></textarea>
                <button type="submit" id="sendMessage">Send Message</button>
            </form>
        </div>
        <hr width="100%" size="2" noshade color="orange" style="margin-top: 50px" />
        <div id="contact">
            <table>
                <tr>
                    <th><img src="./img/address.png" alt="" /></th>
                    <th><img src="./img/Email.png" alt="" /></th>
                    <th><img src="./img/phone.png" alt="" /></th>
                    <th><img src="./img/icons8-time-machine-100.png" alt="" /></th>
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
                        <a href="mailto:info@thegallerycafe.lk">info@thegallerycafe.lk</a>
                    </td>
                    <td style="font-size: 20px; color: silver">+94 77 123 4567</td>
                    <td style="font-size: 20px; color: silver">
                        Opening Time: 8:00 AM<br />
                        Closing Time: 10:00 PM
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>
</html>
