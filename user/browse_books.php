<style>
    h3 {
        margin-bottom: 10px;
        color: #2c3e50;
    }

    /* Success and Error Messages */
    .success {
        color: #27ae60;
        background-color: #ecf9f1;
        border: 1px solid #27ae60;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .error {
        color: #e74c3c;
        background-color: #fdecea;
        border: 1px solid #e74c3c;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    /* Styled Table */
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .styled-table th, .styled-table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .styled-table th {
        background-color: #3498db;
        color: white;
    }

    .styled-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Button Styles */
    .btn-request {
        display: inline-block;
        padding: 8px 16px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-transform: uppercase;
        font-size: 14px;
        font-weight: bold;
        transition: background-color 0.2s;
    }

    .btn-request:hover {
        background-color: #2980b9;
    }
</style>

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
        echo "<p class='success'>Request submitted successfully!</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}

$result = $conn->query("SELECT * FROM books WHERE status = 'available'");
?>

<link rel="stylesheet" href="../assets/css/dashboard.css">
<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="logo">Tomere<span>Lib</span>.</h2>
        <nav class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="browse_books.php" class="active">Browse Books</a>
            <a href="borrow_history.php">Borrow History</a>
        </nav>
        <div class="sidebar-footer">
            <a href="../auth/logout.php"><img src="../assets/images/logout_icon.png" alt="logout" class="logout-icon"> <span>Logout</span></a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <section>
            <h3>Available Books</h3>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($book = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($book['title']) ?></td>
                            <td><?= htmlspecialchars($book['author']) ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                                    <button type="submit" class="btn-request">Request to Borrow</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>
</div>
<script src="../assets/js/script.js"></script>
