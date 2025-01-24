
<?php
require '../config/database.php';
require '../includes/session.php';

checkLogin(); // Ensure the user is logged in
checkRole('librarian'); // Ensure only Librarians can access this page
?>

<link rel="stylesheet" href="../assets/css/dashboard.css">

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="logo">Tomere<span>Lib</span>.</h2>
        <nav class="menu">
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="manage_books.php">Manage Books</a>
            <a href="borrow_requests.php">Borrow Requests</a>
        </nav>
        <div class="sidebar-footer">
            <a href="../auth/logout.php"><img src="../assets/images/logout_icon.png" alt="logout" class="logout-icon"> <span>Logout</span></a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <h1> Dashboard - Welcome Librarian, <?= ucfirst($_SESSION['username']); ?></h1>
            <div class="profile">
                <img src="../assets/images/user_avatar.jpg" alt="User">
                <span><?= ucfirst($_SESSION['username']); ?></span>
            </div>
        </header>

        <!-- Stats Cards -->
        <section class="stats-cards">
            <div class="card">
                <h3>Total Users</h3>
                <p>$2,123,450</p>
            </div>
            <div class="card">
                <h3>Total Number of books</h3>
                <p>1,520</p>
            </div>
            <div class="card">
                <h3>Sales</h3>
                <p>9,721</p>
            </div>
            <div class="card">
                <h3>Users</h3>
                <p>892</p>
            </div>
        </section>

        <!-- Activities and Details -->
        <section class="activities">
        <div class="chart">
                <!-- <h3>User</h3> -->
                <h3>Books</h3>
                 <?php 
                    $sql = "SELECT books.book_id, books.title, books.author, books.isbn, books.copies_available, books.published_year, genres.genre_name 
                    FROM books 
                    JOIN genres ON books.genre_id = genres.genre_id";
                    $result = $conn->query($sql);
                 ?>


                <div class="manage-books-section">
                    <div class="table-wrapper">
                        <table class="styled-table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Genre</th>
                                <th>Copies Available</th>
                                <th>Published Year</th>

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

                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="details">
                <div class="top-products">
                    <h3>Top Products</h3>
                    <ul>
                        <li>Basic Tees</li>
                        <li>Custom Short Pants</li>
                        <li>Super Hoodies</li>
                    </ul>
                </div>
                <div class="schedule">
                    <h3>Today's Schedule</h3>
                    <ul>
                        <li>Check promotions - 9:00 AM</li>
                        <li>Team Meeting - 12:00 PM</li>
                    </ul>
                </div>
            </div>
        </section>

        <footer>
            <p style="text-align: center;">All right reserved, &copy; Pereweitom</p>
        </footer>
    </main>

</div>
<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>