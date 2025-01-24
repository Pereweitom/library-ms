<?php
require '../config/database.php';
require '../includes/session.php';

checkLogin();
checkRole('admin');

$user_id = (int)$_GET['user_id'];

$query = "DELETE FROM users WHERE user_id = $user_id";

if ($conn->query($query)) {
    header('Location: manage_users.php');
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
