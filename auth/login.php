<?php
require '../config/database.php';
require '../includes/session.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header('Location: ../' . $_SESSION['role'] .  '/dashboard.php');;
            exit();
        } else {
            // echo "Invalid password.";
        }
    } else {
        // echo "User not found.";
    }
}
?>
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/auth.css">
<section>
    <div>
        <h1>Welcome to Tomere<span>Lib</span></h1>
        <p>Where knowledge meets opportunity</p>
    </div>
    <form method="POST">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Enter your Username" id="username" required>
        <label for="password">Password:</label>
        <div class="password-toggle">
            <input type="password" name="password" placeholder="Enter your password" id="password" required>
            <span  id="togglePassword" class="toggle-btn">Show</span>
        </div>

        <div class="form-link">
            <a href="#">Forgot Password?</a>
        </div>
        <button type="submit">Login</button>
        <div class="signup-link">
            Not a member? <a href="./register.php">Register here</a>
        </div>
    </form>
</section>


<script src="../assets/js/script.js">


</script>
<?php include '../includes/footer.php'; ?>