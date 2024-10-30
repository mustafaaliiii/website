<?php
$servername = "localhost"; // Database server address
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password (use your password here if it's set)
$dbname = "website"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log the error (consider using a logging library in production)
    error_log("Connection failed: " . $conn->connect_error);
    // Display a user-friendly message
    die("Connection to the database failed. Please try again later.");
}

// Optional: Set character set for the connection
$conn->set_charset("utf8mb4"); // To support a wide range of characters

// Optional: Enable exceptions for MySQLi
$conn->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

?>
