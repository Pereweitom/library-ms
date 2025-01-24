<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $conn->real_escape_string($_POST['book_id']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO requests (user_id, book_id, request_type) 
              VALUES ('$user_id', '$book_id', 'borrow')";
    if ($conn->query($sql)) {
        echo "Request submitted!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM books WHERE status = 'available'");
while ($book = $result->fetch_assoc()) {
    echo "<form method='POST'>
            <p>{$book['title']} by {$book['author']}</p>
            <input type='hidden' name='book_id' value='{$book['book_id']}'>
            <button type='submit'>Request to Borrow</button>
          </form>";
}
?>
