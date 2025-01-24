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

    /* Book List */
    .book-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-around;
        padding: 10px;
    }

    .book-card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        width: 300px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Book Information */
    .book-card h3 {
        font-size: 18px;
        margin: 0;
        color: #34495e;
    }

    .book-card p {
        margin: 5px 0;
        color: #7f8c8d;
    }

    /* Button Styles */
    .btn-request {
        display: inline-block;
        padding: 10px 20px;
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
            <a href="#" class="active">Dashboard</a>
            <a href="browse_books.php">Browse Books</a>
            <a href="borrow_history.php">Borrow History</a>
        </nav>
        <div class="sidebar-footer">
            <a href="../auth/logout.php"><img src="../assets/images/logout_icon.png" alt="logout" class="logout-icon"> <span>Logout</span></a>
        </div>
    </aside>

    <main class="main-content">
        <section>

            <?php
            echo "<div class='book-list'>";
            while ($book = $result->fetch_assoc()) {
                echo "<div class='book-card'>
            <h3>{$book['title']}</h3>
            <p><strong>Author:</strong> {$book['author']}</p>
            <form method='POST'>
                <input type='hidden' name='book_id' value='{$book['book_id']}'>
                <button type='submit' class='btn-request'>Request to Borrow</button>
            </form>
          </div>";
            }
            echo "</div>";
            ?>
        </section>

    </main>

</div>
<script src="../assets/js/script.js"></script>