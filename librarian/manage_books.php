<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Table Section */
    .manage-books-section {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .manage-books-section h3 {
        margin-bottom: 20px;
        font-size: 18px;
        color: #333;
    }

    .add-book-btn {
        display: inline-block;
        margin-bottom: 20px;
        background-color: #468fd2;
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .add-book-btn:hover {
        background-color: #3169a3;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .styled-table thead {
        background-color: #468fd2;
        color: white;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .styled-table th {
        font-weight: bold;
    }

    .styled-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .action-link {
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 5px;
        margin-right: 5px;
    }

    .edit-link {
        background-color: #28a745;
        color: white;
    }

    .edit-link:hover {
        background-color: #218838;
    }

    .delete-link {
        background-color: #dc3545;
        color: white;
    }

    .delete-link:hover {
        background-color: #c82333;
    }

    footer {
        text-align: center;
        color: white;
        border-radius: 10px;
        padding: 10px;
        margin-top: 5px;
        background-color: #2980B9;
    }
</style>


<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();
checkRole('librarian');

// Fetch all books
$sql = "SELECT books.book_id, books.title, books.author, books.isbn, books.copies_available, books.published_year, genres.genre_name 
          FROM books 
          JOIN genres ON books.genre_id = genres.genre_id";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../assets/css/dashboard.css">
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

    <!-- Main Content -->
    <main class="main-content">

        <!-- Activities and Details -->
        <section>
            <div class="manage-books-section">
                <h3>Manage Books</h3>
                <a href="add_book.php" class="add-book-btn">Add New Book</a>
                <!-- <div class="search-books">
                 <form action="search_books.php" method="GET">
                    <input type="text" name="search" placeholder="Search Books">
                    <button type="submit">Search</button>
                </form> 
            </div> -->
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