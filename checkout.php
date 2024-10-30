<?php 
session_start(); // Start the session

// Check if the user is logged in, redirect to login if not
if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}

// Mock user data - replace this with your actual user data retrieval
$user_email = $_SESSION['email'];
$user_name = "John Doe"; // Replace with actual user name
$user_address = ""; // Initialize to empty, replace with actual address if saved
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - TechProStore</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Checkout Section Styles */
        .checkout {
            padding: 40px;
            text-align: center;
            background-color: #1a1a1a;
            color: white;
        }

        .checkout h2 {
            margin-bottom: 30px;
            font-size: 2rem;
            text-transform: uppercase;
            color: #5cb85c;
        }

        #checkout-form {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
            font-size: 16px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 2px solid #444;
            outline: none;
            background-color: transparent;
            color: #fff;
            font-size: 16px;
        }

        .form-group textarea {
            resize: none;
            height: 80px;
        }

        .checkout-button {
            background-color: #5cb85c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 18px;
        }

        .checkout-button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>TechProStore</h1>
        </div>
        <nav>
            <ul>
                <li><a href="main.php">Home</a></li>
                <li><a href="main.php#products">Products</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="user-actions">
            <span>Welcome, <?php echo htmlspecialchars($user_email); ?>!</span>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <section class="checkout">
        <h2>Checkout</h2>
        <form id="checkout-form" method="POST" action="place_order.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_name); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_email); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Shipping Address:</label>
                <textarea id="address" name="address" required><?php echo htmlspecialchars($user_address); ?></textarea>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="zip">Zip Code:</label>
                <input type="text" id="zip" name="zip" required>
            </div>
            <button type="submit" class="checkout-button">Place Order</button>
        </form>
    </section>

    <footer>
        <p>TechProStore © 2024</p>
    </footer>
</body>
</html>
