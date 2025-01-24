<link rel="stylesheet" href="../assets/css/dashboard.css">

<?php
require '../config/database.php';
require '../includes/session.php';

checkLogin(); // Ensure the user is logged in
checkRole('admin'); // Ensure only admins can access this page
?>

<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="logo">Tomere<span>Lib</span>.</h2>
        <nav class="menu">
            <a href="#" class="active">Dashboard</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="manage_books.php">Manage Books</a>
        </nav>
        <div class="sidebar-footer">

            <a href="../auth/logout.php"><img src="../assets/images/logout_icon.png" alt="logout" class="logout-icon"> <span>Logout</span></a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <h1>Admin Dashboard</h1>
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
        <section class="activities">
            <div class="chart">
                <!-- <h3>User</h3> -->
                <h3>Users</h3>
                <?php
                $sql = "SELECT user_id, username, full_name, email, role, created_at FROM users";
                $result = $conn->query($sql);
                ?>


                <div class="manage-users-section">



                    <div class="table-wrapper">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Role</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($user = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?= ucfirst($user['username']) ?></td>
                                        <td><?= $user['full_name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= ucfirst($user['role']) ?></td>

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