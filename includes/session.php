<?php
session_start();

// Redirect if not logged in
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../auth/login.php');
        exit();
    }
}

// Restrict access based on roles (allow single or multiple roles)
function checkRole($roles) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], (array) $roles)) {
        header('Location: ../' . $_SESSION['role'] .  '/dashboard.php');
        exit();
    }
}

?>
