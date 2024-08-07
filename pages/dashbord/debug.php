<?php
session_start();

// Debugging
if (!isset($_SESSION['user_id'])) {
    echo "Session user_id is not set.";
} else {
    echo "Session user_id is set: " . $_SESSION['user_id'];
}
?>
