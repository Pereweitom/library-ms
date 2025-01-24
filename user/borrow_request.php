<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();

if (isset($_GET['book_id'])) {
    $book_id = $conn->real_escape_string($_GET['book_id']);
    $user_id = $_SESSION['user_id'];

    // Insert a borrow request
    $query = "INSERT INTO requests (user_id, book_id, request_type) 
              VALUES ('$user_id', '$book_id', 'borrow')";
    if ($conn->query($query)) {
        echo "Your request has been submitted!";
    } else {
        echo "Error: " . $conn->error;
    }
}
