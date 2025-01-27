<?php
require '../config/database.php';
require '../includes/session.php';

checkLogin();
checkRole('admin');

$book_id = (int)$_GET['book_id'];
$query = "SELECT * FROM books WHERE book_id = $book_id";
$result = $conn->query($query);
$book = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $genre_id = (int)$_POST['genre_id'];
    $isbn = $conn->real_escape_string($_POST['isbn']);
    $copies = (int)$_POST['copies_available'];
    $published_year = (int)$_POST['published_year'];

    $query = "UPDATE books SET title = '$title', author = '$author', genre_id = '$genre_id', isbn = '$isbn', copies_available = '$copies', published_year = '$published_year' WHERE book_id = $book_id";

    if ($conn->query($query)) {
        header('Location: manage_books.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<link rel="stylesheet" href="../assets/css/dashboard.css">
<link rel="stylesheet" href="../assets/css/form.css">
<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="logo">Tomere<span>Lib</span>.</h2>
        <nav class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="manage_books.php" class="active">Manage Books</a>
        </nav>
        <div class="sidebar-footer">
            <a href="../auth/logout.php"><img src="../assets/images/logout_icon.png" alt="logout" class="logout-icon"> <span>Logout</span></a>
        </div>
    </aside>

    <main class="main-content">
        <section class="register_section">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="register_form">
                <h2>Edit Book</h2>
                <label>Title:</label>
                <input type="text" name="title" value="<?= $book['title'] ?>" required>
                <br>
                <label>Author:</label>
                <input type="text" name="author" value="<?= $book['author'] ?>" required>

                <br>
                <label>ISBN:</label>
                <input type="text" name="isbn" value="<?= $book['isbn'] ?>" required>
                <br>
                <label>Copies Available:</label>
                <input type="number" name="copies_available" value="<?= $book['copies_available'] ?>" required>
                <br>
                <label>Published Year:</label>
                <input type="number" name="published_year" value="<?= $book['published_year'] ?>" required>
                <br>
                <button type="submit">Update Book</button>
            </form>

        </section>

    </main>

</div>
<script src="../assets/js/script.js"></script>