<?php
session_start(); // Start the session
session_unset();  // Remove all session variables
session_destroy(); // Destroy the session

// Redirect to the main page after logout
header("Location: main.php");
exit();
?>
