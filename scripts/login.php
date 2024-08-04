<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    // Check for admin login
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['admin'] = true;
        header("Location: ../html/admin.php");
        exit();
    }

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        header("Location: ../html/menu-page.php");
        exit();
    } else {
        header("Location: ../html/login-page.php?login_error=1");
        exit();
    }
}
?>