<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();
checkRole('librarian');

// Fetch genres
$genres = $conn->query("SELECT * FROM genres");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $genre_id = (int)$_POST['genre_id'];
    $isbn = $conn->real_escape_string($_POST['isbn']);
    $copies = (int)$_POST['copies_available'];
    $published_year = (int)$_POST['published_year'];

    $sql = "INSERT INTO books (title, author, genre_id, isbn, copies_available, published_year)
              VALUES ('$title', '$author', '$genre_id', '$isbn', '$copies', '$published_year')";

    if ($conn->query($sql)) {
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
            <a href="manage_books.php" class="active">Manage Books</a>
            <a href="borrow_requests.php">Borrow Requests</a>
        </nav>
        <div class="sidebar-footer">
            <a href="../auth/logout.php"><img src="../assets/images/logout_icon.png" alt="logout" class="logout-icon"> <span>Logout</span></a>
        </div>
    </aside>

    <main class="main-content">
        <section class="register_section">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="register_form">
                <h2>Add books</h2>
                <label>Title:</label>
                <input type="text" name="title" required>
                <br>
                <label>Author:</label>
                <input type="text" name="author" required>
                <br>
                <label>Genre:</label>
                <select name="genre_id" required>
                    <?php while ($genre = $genres->fetch_assoc()) : ?>
                        <option value="<?= $genre['genre_id'] ?>"><?= $genre['genre_name'] ?></option>
                    <?php endwhile; ?>
                </select>
                <br>
                <label>ISBN:</label>
                <input type="text" name="isbn" required>
                <br>
                <label>Copies Available:</label>
                <input type="number" name="copies_available" required>
                <br>
                <label>Published Year:</label>
                <input type="number" name="published_year" required>
                <br>
                <button type="submit">Add Book</button>
            </form>
        </section>

    </main>

</div>
<script src="../assets/js/script.js"></script>