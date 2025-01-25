<style>
    /* General Styles */

h3 {
    margin-bottom: 10px;
    color: #2c3e50;
}

/* Success and Error Messages */
.success {
    color: #27ae60;
    background-color: #ecf9f1;
    border: 1px solid #27ae60;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.error {
    color: #e74c3c;
    background-color: #fdecea;
    border: 1px solid #e74c3c;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}

/* Table Wrapper */
.book-table-wrapper {
    margin-top: 20px;
    overflow-x: auto;
}

/* Book Table */
.book-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: left;
    background-color: #ffffff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.book-table thead tr {
    background-color: #3498db;;
    color: #ffffff;
    text-transform: uppercase;
}

.book-table th,
.book-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

.book-table tbody tr {
    transition: background-color 0.3s;
}

.book-table tbody tr:hover {
    background-color: #f2f2f2;
}

/* Button Styles */
.btn-request {
    padding: 8px 12px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-transform: uppercase;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.2s;
}

.btn-request:hover {
    background-color: #2980b9;
}

.request-form {
    display: inline-block;
    margin: 0;
}

</style>

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