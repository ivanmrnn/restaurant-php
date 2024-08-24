<?php
session_start();
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and password from the submitted form data
    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    // Prepare the SQL query to select the user with the given username and password
    $loginQuery = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $queryResult = mysqli_query($conn, $loginQuery);

    // Check if the username and password match an existing user
    if (mysqli_num_rows($queryResult) > 0) {
        $user = mysqli_fetch_assoc($queryResult); // Fetch the user's data as an associative array
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['username'] = $user['username']; 

        // Redirect the user to the menu page after successful login
        header("Location: ../html/menu-page.php");
        exit();
    } else {
        // If the login fails, redirect the user back to the login page with an error
        header("Location: ../html/login-page.php?login_error=1");
        exit();
    }
}
?>