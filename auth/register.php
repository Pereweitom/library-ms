<style>
    * {
        box-sizing: border-box;
    }

    section {
        display: flex;
        width: 90%;
        align-items: center;
        margin-top: 20px;
        justify-content: space-around;

    }

    section>* {
        flex-basis: 1;
    }

    section>div {
        border-left: 4px solid white;
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
        padding: 10px;
        color: white;
    }

    h1 {
        font-size: 2rem;
    }

    form {
        width: 40%;
        padding: 20px 20px;
        background-color: white;
        border-radius: 8px;

    }

    form>h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;

    }

    input, select {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;

    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .password-toggle {
        display: flex;
        align-items: center;
        position: relative;
    }

    .password-toggle > .toggle-btn {
        position: absolute;
        right: 10px;
        top: 40%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #007bff;
        font-size: 12px;
        cursor: pointer;
    }

    .password-toggle .toggle-btn:hover {
        text-decoration: underline;
    }
    .signup-link {
        text-align: center;
        margin-top: 10px;
        font-size: 14px;
    }

    .signup-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

</style>




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
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<section>
    <div>
        <h1>Welcome to TomereLib</h1>
        <p>Where knowledge meets opportunity</p>
    </div>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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