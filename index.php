<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomere Library</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #2980B9;
        }

        header {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            height: 60px;
            width: 90%;
            margin: 0 auto;
            color: white;

        }

        h2 {
            font-size: 1.5em;
            color: white;
        }

        span {
            color: #E74C3C;
        }

        li {
            display: inline-block;
            padding: 4px;

        }

        li>a {
            text-decoration: none;
            color: white;

        }

        main {
            text-align: center;
            margin-top: 100px;
            color: white;
        }

        a {
            text-decoration: none;
            color: white;
            padding: 10px;
            margin: 10px;
            border: 1px solid white;
            border-radius: 5px;
        }

        .auth {
            text-align: center;
            margin-top: 50px;
        }

        .login {
            background-color: #E74C3C;
            color: white;
            border: none;
        }

        .register {
            background-color: white;
            color: #2980B9;
            border: none;
        }
    </style>
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