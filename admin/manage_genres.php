<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();
checkRole('admin');

// Fetch genres
$result = $conn->query("SELECT * FROM genres");
?>

<h3>Manage Genres</h3>
<a href="add_genre.php">Add New Genre</a>

<table border="1">
    <tr>
        <th>Genre Name</th>
        <th>Actions</th>
    </tr>
    <?php while ($genre = $result->fetch_assoc()) : ?>
    <tr>
        <td><?= $genre['genre_name'] ?></td>
        <td>
            <a href="edit_genre.php?genre_id=<?= $genre['genre_id'] ?>">Edit</a>
            <a href="delete_genre.php?genre_id=<?= $genre['genre_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
