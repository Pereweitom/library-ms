<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Table Section */
    .manage-users-section {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .manage-users-section h3 {
        margin-bottom: 20px;
        font-size: 18px;
        color: #333;
    }

    .add-user-btn {
        display: inline-block;
        margin-bottom: 20px;
        background-color: #468fd2;
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .add-user-btn:hover {
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
checkRole('admin');



// Fetch all users
$sql = "SELECT user_id, username, full_name, email, role, created_at FROM users";
$result = $conn->query($sql);
?>
<link rel="stylesheet" href="../assets/css/dashboard.css">
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