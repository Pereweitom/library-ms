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
                <canvas id="myChart"></canvas>            
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