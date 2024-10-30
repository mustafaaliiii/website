<?php
session_start(); // Start the session at the top of the script
include 'db.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['username']; // Assuming you are using email as the username
    $password = $_POST['password'];

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Store user email in session
            $_SESSION['email'] = $email; 
            
            // Redirect to the main page
            header("Location: main.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }

    $stmt->close();
}
$conn->close();
?>
