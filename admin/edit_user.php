<?php
require '../config/database.php';
require '../includes/session.php';

checkLogin();
checkRole('admin');

$user_id = (int)$_GET['user_id'];
$query = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($query);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $role = $conn->real_escape_string($_POST['role']);

    $query = "UPDATE users SET username = '$username', full_name = '$full_name', email = '$email', role = '$role' WHERE user_id = $user_id";

    if ($conn->query($query)) {
        header('Location: manage_users.php');
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
            <a href="manage_users.php" class="active">Manage Users</a>
            <a href="manage_books.php">Manage Books</a>
        </nav>
        <div class="sidebar-footer">
            <a href="../auth/logout.php"><img src="../assets/images/logout_icon.png" alt="logout" class="logout-icon"> <span>Logout</span></a>
        </div>
    </aside>

    <main class="main-content">
        <section>
            <form method="POST">
                <h2>Edit User</h2>
                <label>Username:</label>
                <input type="text" name="username" value="<?= $user['username'] ?>" required>
                <br>
                <label>Full Name:</label>
                <input type="text" name="full_name" value="<?= $user['full_name'] ?>" required>
                <br>
                <label>Email:</label>
                <input type="email" name="email" value="<?= $user['email'] ?>" required>
                <br>
                <label>Role:</label>
                <select name="role" required>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="librarian" <?= $user['role'] === 'librarian' ? 'selected' : '' ?>>Librarian</option>
                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                </select>
                <br>
                <button type="submit">Update User</button>
            </form>

        </section>

    </main>

</div>
<script src="../assets/js/script.js"></script>