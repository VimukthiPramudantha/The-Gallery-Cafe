<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $item_id = intval($_POST['item_id']);

    $sql = "DELETE FROM menu_item WHERE id = $item_id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Menu Item Deleted Successfully";
    } else {
        $_SESSION['message'] = "Error deleting record: " . mysqli_error($conn);
    }
    header("Location: manage_menu_items.php");
    exit();
}


$sql = "SELECT id, name, description, price, image, category_name FROM menu_item";
$result = mysqli_query($conn, $sql);

$items = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $items[$row['category_name']][] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Menu Items - The Gallery Cafe</title>
    <link rel="stylesheet" href="../CSS/manage_menu_items.css" />
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <main>
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
            <div id="items">
            <div class="dis2">
                <h2>Manage Menu Items</h2>

                </div>
                <?php if (!empty($_SESSION['message'])): ?>
                    <script>
                        showAlert("<?php echo $_SESSION['message']; ?>");
                    </script>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $category_name => $category_items): ?>
                        <section id="selection">
                            <h2><?php echo htmlspecialchars($category_name); ?></h2>
                            <div class="menu-grid">
                                <?php foreach ($category_items as $item): ?>
                                    <div class="dis">
                                        <h2 class="h2"><?php echo htmlspecialchars($item['name']); ?></h2>
                                        <?php if ($item['image']): ?>
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image']); ?>" alt="" class="image" />
                                        <?php endif; ?>
                                        <form action="manage_menu_items.php" method="POST">
                                            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                            <button type="submit" name="delete" class="delete">Delete</button>
                                        </form>
                                        <div>
                                            <p><?php echo htmlspecialchars($item['description']); ?></p>
                                            <p><strong>Price: </strong><?php echo number_format($item['price'], 2); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No items found.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>
