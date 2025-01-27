<?php
require '../config/database.php';
require '../includes/session.php';
checkLogin();

$user_id = $_SESSION['user_id'];

$sql = "SELECT requests.request_id, books.title, books.author, requests.request_type, 
                 requests.status, requests.request_date
          FROM requests
          JOIN books ON requests.book_id = books.book_id
          WHERE requests.user_id = '$user_id'
          ORDER BY requests.request_date DESC";

$result = $conn->query($sql);
?>

<link rel="stylesheet" href="../assets/css/dashboard.css">
<link rel="stylesheet" href="../assets/css/borrow_history.css">
<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="logo">Tomere<span>Lib</span>.</h2>
        <nav class="menu">
            <a href="dashboard.php">Dashboard</a>
            <a href="browse_books.php">Browse Books</a>
            <a href="borrow_history.php" class="active">Borrow History</a>
        </nav>
        <div class="sidebar-footer">
            <a href="../auth/logout.php"><img src="../assets/images/logout_icon.png" alt="logout" class="logout-icon"> <span>Logout</span></a>
        </div>
    </aside>

    <main class="main-content">
        <section>

            <h3>Your Borrowing History</h3>
          
            <?php
            echo "<div class='book-table-wrapper'>";
            echo "<table class='book-table'>";
            echo "<thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Request type</th>
            <th>Request Status</th>
            <th>Request date</th>      
        </tr>
      </thead>";
            echo "<tbody>";
            if($result->num_rows > 0){
                while ($request = $result->fetch_assoc()) {
                    echo "<tr>
                <td>{$request['title']}</td>
                <td>{$request['author']}</td>
                <td>{$request['request_type']}</td>
                <td>{$request['status']}</td>
                <td>{$request['request_date']}</td>
              </tr>";
                }
    
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }else {
                echo "<p>No borrowing history found.</p>";
            }
           
            ?>
        </section>

    </main>

</div>
<script src="../assets/js/script.js"></script>