<?php 
require '../config/database.php';
require '../includes/session.php';

checkLogin();
checkRole('admin');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $genre_name = $conn->real_escape_string($_POST['genre_name']);
    $sql = "INSERT INTO genres (genre_name) VALUES ('$genre_name')";
    
    if($conn->query($sql)){
    header('Location: manage_genres.php');
    exit();
    }else {
        echo 'Error:'. $conn->error;
    }

}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="genre_name">Genre Name:</label>
    <input type="text" name="genre_name" id="genre_name" required>
    <button type="submit">Add Genre</button>
</form>