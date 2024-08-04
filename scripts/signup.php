<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['signup-username'];
    $password = $_POST['signup-password'];
    $confirm_password = $_POST['signup-confirm-password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        header("Location: ../html/login-page.php?signup_error=3&show_signup=1");
        exit();
    }

    // Check if username already exists
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        header("Location: ../html/login-page.php?signup_error=1&show_signup=1");
        exit();
    }

    // Insert new user with default discount of 10
    $insert_query = "INSERT INTO users (username, password, discount) VALUES ('$username', '$password', 10)";
    if (mysqli_query($conn, $insert_query)) {
        $_SESSION['username'] = $username;
        header("Location: ../html/menu-page.php");
        exit();
    } else {
        header("Location: ../html/login-page.php?signup_error=2&show_signup=1");
        exit();
    }
}
?>