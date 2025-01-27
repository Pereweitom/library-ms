<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomere Library</title>
    <link rel="stylesheet" href="./assets/css/home.css">
</head>

<body>
    <header>
        <h2>Tomere<span>Lib</span></h2>
        <nav>
            <ul>
                <li><a href="./auth/login.php">Login</a></li>
                <li><a href="./auth/register.php">Register</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Welcome to Tomere Library</h1>
        <p>You go to home for academics resources and knowledge</p>
    </main>

    <div class="auth">
        <a href="./auth/login.php" class="login">Login</a>
        <a href="./auth/register.php" class="register">Register</a>
    </div>

    <?php include './includes/footer.php' ?>
</body>

</html>