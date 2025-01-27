<?php
require '../config/database.php';
require '../includes/session.php';

checkLogin();
checkRole('admin');



// Fetch all users
$sql = "SELECT user_id, username, full_name, email, role, created_at FROM users";
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
            <a href="manage_users.php" class="active">Manage Users</a>
            <a href="manage_books.php">Manage Books</a>
        </nav>
        <div class="sidebar-footer">

            <a href="../auth/logout.php"><img src="../assets/images/logout_icon.png" alt="logout" class="logout-icon"> <span>Logout</span></a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <!-- Activities and Details -->
        <section>
            <div class="manage-users-section">
                <h3>Manage Users</h3>
                <a href="add_user.php" class="add-user-btn">Add New User</a>

                <div class="table-wrapper">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($user = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['full_name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= ucfirst($user['role']) ?></td>
                                    <td><?= $user['created_at'] ?></td>
                                    <td>
                                        <a href="edit_user.php?user_id=<?= $user['user_id'] ?>" class="action-link edit-link">Edit</a>
                                        <a href="delete_user.php?user_id=<?= $user['user_id'] ?>" class="action-link delete-link" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <footer>
                <p style="text-align: center;">All right reserved, &copy; Pereweitom</p>
            </footer>
        </section>
    </main>
</div>