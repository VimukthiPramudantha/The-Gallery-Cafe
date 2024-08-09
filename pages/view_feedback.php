<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <link rel="stylesheet" href="../CSS/view_feedback.css">
    <link rel="shortcut icon" href="../images/Logo.png" type="image/x-icon">
</head>
<body>
    
    <div class="container">
    <aside>
            <h2>Admin Dashboard</h2>
            <ul>
                    <li><a href="./Home.php">Home</a></li>
                    <li><a href="./dashbord.php">Dashboard</a></li>
                    <li><a href="./profile.php">Profile</a></li>
                    <li><a href="./add_user.php">Users</a></li>
                    <li><a href="./add_menu.php">Manage Menu</a></li>
                    <li><a href="./manage_menu_items.php">Delete Menu Items</a></li>
                    <li><a href="./admin_view_reservations.php">Reservations</a></li>
                    <li><a href="./promotion.php">Promotions</a></li>
                    <li><a href="./view_feedback.php">Feedback</a></li>
                </ul>
        </aside>
        <main>
            <div class="feedback-container">
                <h1>Feedback List</h1>
                <?php
                
               include("../dataBaseConnection.php");

                
                $sql = "SELECT name, email, subject, message FROM feedback";
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
                    
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['subject']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['message']) . '</td>';
                        echo '</tr>';
                    }
                    
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No feedback available.</p>';
                }

            
                mysqli_close($conn);
                ?>
            </div>
        </main>
    </div>
   
</body>
</html>
