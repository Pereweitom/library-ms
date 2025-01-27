<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();
checkRole('admin');

// Fetch all books
$sql = "SELECT books.book_id, books.title, books.author, books.isbn, books.copies_available, books.published_year, genres.genre_name 
          FROM books 
          JOIN genres ON books.genre_id = genres.genre_id";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../assets/css/dashboard.css">
<link rel="stylesheet" href="../assets/css/manage.css">
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

    <!-- Main Content -->
    <main class="main-content">
        <!-- Activities and Details -->
        <section>
            <div class="manage-books-section">
                <h3>Manage Books</h3>
                <a href="add_book.php" class="add-book-btn">Add New Book</a>
                
                <div class="table-wrapper">

                </div>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Genre</th>
                            <th>Copies Available</th>
                            <th>Published Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($book = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?= $book['title'] ?></td>
                                <td><?= $book['author'] ?></td>
                                <td><?= $book['isbn'] ?></td>
                                <td><?= $book['genre_name'] ?></td>
                                <td><?= $book['copies_available'] ?></td>
                                <td><?= $book['published_year'] ?></td>
                                <td>
                                    <a href="edit_book.php?book_id=<?= $book['book_id'] ?>" class="action-link edit-link">Edit</a>
                                    <a href="delete_book.php?book_id=<?= $book['book_id'] ?>" class="action-link delete-link" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
            <footer>
                <p style="text-align: center;">All right reserved, &copy; Pereweitom</p>
            </footer>
        </section>