<?php
session_start();
include 'db.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact_no = $_POST['contact_no'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email already exists
        $_SESSION['error'] = "This email is already registered. Please use a different email.";
        header("Location: register.html"); // Redirect back to registration page
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (name, contact_no, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $contact_no, $email, $hashed_password);

    if ($stmt->execute()) {
        // Registration successful
        $_SESSION['success'] = "Registration successful! You can now log in.";
        header("Location: index.html"); // Redirect to the login page
        exit();
    } else {
        // Registration failed
        $_SESSION['error'] = "There was an error while registering. Please try again.";
        header("Location: register.html"); // Redirect back to registration page
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
