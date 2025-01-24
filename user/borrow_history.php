<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();

$user_id = $_SESSION['user_id'];

$sql = "SELECT requests.request_id, books.title, books.author, requests.request_type, 
                 requests.status, requests.request_date
          FROM requests
          JOIN books ON requests.book_id = books.book_id
          WHERE requests.user_id = '$user_id'
          ORDER BY requests.request_date DESC";

$result = $conn->query($sql);
?>

<h3>Your Borrowing History</h3>
<?php
if ($result->num_rows > 0) {
    while ($request = $result->fetch_assoc()) {
        echo "<div>
                <p><strong>{$request['title']}</strong> by {$request['author']}</p>
                <p>Type: {$request['request_type']}, Status: {$request['status']}</p>
                <p>Requested on: {$request['request_date']}</p>
              </div>";
    }
} else {
    echo "<p>No borrowing history found.</p>";
}
?>
