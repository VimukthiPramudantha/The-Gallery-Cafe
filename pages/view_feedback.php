<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <link rel="stylesheet" href="../CSS/view_feedback.css">
</head>
<body>
    <header>
        <div class="logo">Admin Dashboard</div>
        <nav>
            <ul>
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="view-reservations.html">View Reservations</a></li>
                <li><a href="add-menu-item.html">Add Menu Item</a></li>
                <li><a href="view-feedback.php" class="active">View Feedback</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <aside>
            <ul>
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="view-reservations.html">View Reservations</a></li>
                <li><a href="add-menu-item.html">Add Menu Item</a></li>
                <li><a href="view-feedback.php" class="active">View Feedback</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </aside>
        <main>
            <div class="feedback-container">
                <h1>Feedback List</h1>
                <?php
                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = " ";
                $dbname = "gallery_cafe";

                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch feedback from database
                $sql = "SELECT name, email, subject, feedback FROM feedback";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '<table>';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Name</th>';
                    echo '<th>Email</th>';
                    echo '<th>Subject</th>';
                    echo '<th>Feedback</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['subject']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['feedback']) . '</td>';
                        echo '</tr>';
                    }
                    
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No feedback available.</p>';
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>
        </main>
    </div>
   
</body>
</html>
