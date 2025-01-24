

<style>
    * {
        box-sizing: border-box;
    }

    section {
        display: flex;
        width: 90%;
        align-items: center;
        margin-top: 100px;
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
        padding: 40px 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);

    }

    form>h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;

    }

    label {
        display: block;
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }

    input {
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

    .form-link {
        text-align: right;
        margin-bottom: 15px;
    }

    .form-link a {
        font-size: 12px;
        color: #007bff;
        text-decoration: none;
    }

    .form-link a:hover {
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
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
<section>
    <div>
        <h1>Welcome to TomereLib</h1>
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