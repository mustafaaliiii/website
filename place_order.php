<?php 
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $zip = htmlspecialchars($_POST['zip']);

    // Process the order here (e.g., save to database, send confirmation email)
    // For now, we'll just mock the order placement with a success message

    // Clear the cart (assuming you want to clear it after order placement)
    unset($_SESSION['cart']); // Or however you manage the cart

    echo "<h1>Order Placed Successfully!</h1>";
    echo "<p>Thank you, $name! Your order will be shipped to:</p>";
    echo "<p>$address, $city, $zip</p>";
    echo "<p>A confirmation email has been sent to $email.</p>";
    echo "<a href='main.php'>Return to Home</a>";
} else {
    // Redirect to checkout if accessed directly
    header("Location: checkout.php");
    exit();
}
?>
