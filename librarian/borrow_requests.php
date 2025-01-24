<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();
checkRole('librarian');

if (isset($_GET['action'])) {
    $request_id = $conn->real_escape_string($_GET['request_id']);
    $action = $conn->real_escape_string($_GET['action']);

    if ($action === 'approve') {
        $conn->query("UPDATE requests SET status = 'approved' WHERE request_id = $request_id");
    } elseif ($action === 'decline') {
        $conn->query("UPDATE requests SET status = 'declined' WHERE request_id = $request_id");
    }
}


$result = $conn->query("SELECT requests.*, users.username, books.title 
                        FROM requests
                        JOIN users ON requests.user_id = users.user_id
                        JOIN books ON requests.book_id = books.book_id");

while ($request = $result->fetch_assoc()) {
    echo "<div>
            <p>{$request['username']} requested to {$request['request_type']} '{$request['title']}'</p>
            <a href='?request_id={$request['request_id']}&action=approve'>Approve</a>
            <a href='?request_id={$request['request_id']}&action=decline'>Decline</a>
          </div>";
}
?>
