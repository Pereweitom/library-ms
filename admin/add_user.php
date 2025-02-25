<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();
checkRole('admin');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $role = $conn->real_escape_string($_POST['role']);

    $sql = "INSERT INTO users (username, password, full_name, email, role) 
              VALUES ('$username', '$password', '$full_name', '$email', '$role')";

    if ($conn->query($sql)) {
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h2>Add user</h2>
                <input type="text" name="username" placeholder="Enter Username" required>
                <div class="password-toggle">
                    <input type="password" name="password" placeholder="Enter Password" id="password" required>
                    <span id="togglePassword" class="toggle-btn">Show</span>
                </div>
                <input type="text" name="full_name" placeholder="Enter your Full name" required>
                <input type="email" name="email" placeholder="Email" required>
                <select name="role" required>
                    <option value="user">User</option>
                    <option value="librarian">Librarian</option>
                </select>
                <button type="submit">Add User</button>
            </form>

        </section>

    </main>

</div>

<script src="../assets/js/script.js"></script>