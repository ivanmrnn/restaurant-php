<?php
// Define database connection parameters
$servername = "localhost"; // Hostname of the MySQL server
$username = "root"; //Username for accessing the MySQL server
$password = ""; //Password for the MySQL user
$db_name = "restaurant"; //Name of the database to connect to

// Establishes a connection to a MySQL database. $conn object represents the connection and allows for interacting with the database.
$conn = new mysqli($servername, $username, $password, $db_name);

// Check if the connection was successful
if ($conn->connect_error) {

    // If there was an error connecting, output an error message and stop the script
    die("Connection Failed: " . $conn->connect_error);
}
?>