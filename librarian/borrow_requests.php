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
?>

<link rel="stylesheet" href="../assets/css/dashboard.css">
<link rel="stylesheet" href="../assets/css/borrow_request.css">

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="logo">Tomere<span>Lib</span>.</h2>
        <nav class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_books.php">Manage Books</a>
            <a href="borrow_requests.php" class="active">Borrow Requests</a>
        </nav>
        <div class="sidebar-footer">
            <a href="../auth/logout.php"><img src="../assets/images/logout_icon.png" alt="logout" class="logout-icon"> <span>Logout</span></a>
        </div>
    </aside>


    <!-- Main Content -->
    <main class="main-content">
        <h3>Manage Book Requests</h3>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Book Title</th>
                    <th>Request Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($request = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= ucfirst($request['username']) ?></td>
                        <td><?= $request['title'] ?></td>
                        <td><?= ucfirst($request['request_type']) ?></td>
                        <td><?= ucfirst($request['status']) ?></td>
                        <td>
                            <a href="?request_id=<?= $request['request_id'] ?>&action=approve" class="btn-approve">Approve</a>
                            <a href="?request_id=<?= $request['request_id'] ?>&action=decline" class="btn-decline">Decline</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</div>

