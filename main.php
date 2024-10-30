<?php 
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page - TechProStore</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>TechProStore</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="#"><i class="fas fa-laptop"></i> Products</a></li>
                <li><a href="#"><i class="fas fa-phone"></i> Contact</a></li>
            </ul>
        </nav>
        <div class="user-actions">
            <?php if (isset($_SESSION['email'])): ?>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?>!</span>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <?php else: ?>
                <a href="index.html"><i class="fas fa-sign-in-alt"></i> Login</a>
            <?php endif; ?>
            <a href="#cart" class="cart-icon"><i class="fas fa-shopping-cart"></i> <span id="cart-count">0</span></a>
        </div>
    </header>

    <section class="hero">
        <h2>Welcome to TechProStore!</h2>
        <p>Explore the latest tech gadgets and accessories.</p>
        <a href="#products" class="btn">Shop Now</a>
    </section>

    <section id="products">
        <h2>Our Products</h2>
        <div class="product-container">
            <!-- Example Product Cards -->
            <div class="product-card">
                <img src="laptop.jpg" alt="Laptop">
                <h3>Gaming Laptop</h3>
                <p>$1,200</p>
                <button class="buy-button" onclick="addToCart('Gaming Laptop', 1200)">Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="mouse.jpg" alt="Mouse">
                <h3>Wireless Mouse</h3>
                <p>$50</p>
                <button class="buy-button" onclick="addToCart('Wireless Mouse', 50)">Add to Cart</button>
            </div>
            <!-- Add more product cards as needed -->
        </div>
    </section>

    <!-- Shopping Cart Section -->
    <section id="cart">
        <h2>Shopping Cart</h2>
        <div class="cart-container">
            <ul id="cart-items">
                <!-- Cart items will appear here -->
            </ul>
            <div class="cart-total">
                <p>Total: $<span id="cart-total">0</span></p>
                <button class="checkout-button" onclick="checkout()">Checkout</button>
                <button class="clear-cart-button" onclick="clearCart()">Clear Cart</button> <!-- Button to clear cart -->
            </div>
        </div>
    </section>

    <footer>
        <p>TechProStore © 2024</p>
    </footer>

    <script>
        // Initialize cart and total on page load
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

        // Function to add an item to the cart
        function addToCart(productName, productPrice) {
            const existingProduct = cart.find(item => item.name === productName);
            if (existingProduct) {
                existingProduct.quantity++; // Increase quantity
            } else {
                cart.push({ name: productName, price: productPrice, quantity: 1 }); // Add new product
            }

            // Update total price
            total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            updateCart(); // Update cart display
            localStorage.setItem('cart', JSON.stringify(cart)); // Save cart to local storage
            document.getElementById('cart-count').innerText = cart.length; // Update cart count
        }

        // Function to update the cart display
        function updateCart() {
            const cartContainer = document.getElementById('cart-items');
            const totalElement = document.getElementById('cart-total');
            
            // Clear the current cart display
            cartContainer.innerHTML = '';

            // Loop through cart items and display them
            cart.forEach((item, index) => {
                const li = document.createElement('li');
                li.textContent = `${item.name} - $${item.price.toFixed(2)} x ${item.quantity}`;
                
                // Create remove button
                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.onclick = () => removeFromCart(index); // Remove item from cart
                li.appendChild(removeButton);
                cartContainer.appendChild(li);
            });

            totalElement.textContent = `Total: $${total.toFixed(2)}`; // Update total display
        }

        // Function to remove an item from the cart
        function removeFromCart(index) {
            total -= cart[index].price * cart[index].quantity; // Decrease total
            cart.splice(index, 1); // Remove item from cart

            // Recalculate total after removal
            total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            updateCart(); // Update cart display
            document.getElementById('cart-count').innerText = cart.length; // Update cart count
            localStorage.setItem('cart', JSON.stringify(cart)); // Save updated cart
        }

        // Function to clear the cart
        function clearCart() {
            cart = []; // Clear cart
            total = 0; // Reset total
            updateCart(); // Update display
            localStorage.removeItem('cart'); // Remove from local storage
        }

        // Load cart on page load
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('cart-count').innerText = cart.length; // Set cart count on load
            updateCart(); // Update cart display
        });

        // Function to handle checkout
function checkout() {
    if (cart.length === 0) {
        alert("Your cart is empty. Please add items before checking out.");
        return;
    }

    // Redirect to checkout page
    window.location.href = 'checkout.php'; // Redirect to checkout page
}

    </script>
</body>
</html>
