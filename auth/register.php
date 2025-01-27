<?php
require '../config/database.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $role = $conn->real_escape_string($_POST['role']);

    $sql = "INSERT INTO users (username, password, full_name, email, role) 
              VALUES ('$username', '$password', '$full_name', '$email', '$role')";

    if ($conn->query($sql)) {
        // echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        // echo "Error: " . $conn->error;
    }
}
?>
<link rel="stylesheet" href="../assets/css/auth.css">

<section class="register_section">
    <div>
        <h1>Welcome to TomereLib</h1>
        <p>Where knowledge meets opportunity</p>
    </div>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="register_form">
        <h2>Registeration</h2>
        <input type="text" name="username" placeholder="Enter your Username" required>
        <div class="password-toggle">
            <input type="password" name="password" placeholder="Enter your password" id="password" required>
            <span  id="togglePassword" class="toggle-btn">Show</span>
        </div>
        <!-- <input type="password" name="confirm_password" placeholder="Confirm your password" required> -->
        <input type="text" name="full_name" placeholder="Enter your Full name" required>
        <input type="email" name="email" placeholder="Email" required>
        <select name="role" required>
            <option value="user">User</option>
        </select>
        <button type="submit">Register</button>
        <div class="signup-link">
            Already have an account? <a href="./login.php">Login here</a>
        </div>
    </form>
</section>

<script src="../assets/js/script.js"></script>
<?php
include '../includes/footer.php';
?>