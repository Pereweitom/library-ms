<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    section {
        display: flex;
        width: 90%;
        align-items: center;
        margin-top: 20px;
        justify-content: center;

    }

    h1 {
        font-size: 2rem;
    }

    form {
        width: 50%;
        padding: 40px 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);

    }

    form>h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;

    }

    label {
        display: block;
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }

    input, select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;

    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

</style>


<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();
checkRole(['admin', 'librarian']);

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
    <section>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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