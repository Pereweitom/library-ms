<?php
require '../config/database.php';
require '../includes/session.php';

checkLogin(); // Ensure the user is logged in
checkRole('user'); // Ensure only users can access this page
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

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <h1>Dashboard - Welcome <?= ucfirst($_SESSION['username']); ?></h1>
            <div class="profile">
                <img src="../assets/images/user_avatar.jpg" alt="User">
                <span><?= ucfirst($_SESSION['username']); ?></span>
            </div>
        </header>

        <?php

        // Query to get total users
        $user_query = "SELECT COUNT(*) AS total_users FROM users";
        $user_result = $conn->query($user_query);
        $total_users = $user_result->fetch_assoc()['total_users'];

        // Query to get total books
        $book_query = "SELECT COUNT(*) AS total_books FROM books";
        $book_result = $conn->query($book_query);
        $total_books = $book_result->fetch_assoc()['total_books'];

        ?>
        <!-- Stats Cards -->
        <section class="stats-cards">
            <div class="card">
                <h3>Total Users</h3>
                <p><?= $total_users ?></p>
            </div>
            <div class="card">
                <h3>Total Number of books</h3>
                <p><?= $total_books ?></p>
            </div>

        </section>

        <!-- Activities and Details -->
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
                <div class="calendar">
                    <h3>Calendar</h3>
                    <div id="calendar"></div>
                </div>
            </div>

        </section>

        <footer>
            <p style="text-align: center;">All right reserved, &copy; Pereweitom</p>
        </footer>
    </main>

</div>
<script src="../assets/js/script.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
  const calendarEl = document.getElementById("calendar");
  const now = new Date();
  const month = now.toLocaleString("default", { month: "long" });
  const year = now.getFullYear();

  const daysInMonth = new Date(year, now.getMonth() + 1, 0).getDate();
  const firstDay = new Date(year, now.getMonth(), 1).getDay();

  let calendarHTML = `<div><strong>${month} ${year}</strong></div><table>`;
  calendarHTML += "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr><tr>";

  for (let i = 0; i < firstDay; i++) {
      calendarHTML += "<td></td>";
  }

  for (let day = 1; day <= daysInMonth; day++) {
      calendarHTML += `<td>${day}</td>`;
      if ((day + firstDay) % 7 === 0) calendarHTML += "</tr><tr>";
  }

  calendarHTML += "</tr></table>";
  calendarEl.innerHTML = calendarHTML;
});
</script>