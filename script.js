// Password Strength Checker
function checkPasswordStrength() {
    const password = document.getElementById('password').value;
    const strengthBar = document.getElementById('strength-bar');
    const requirements = {
        length: document.getElementById('length'),
        uppercase: document.getElementById('uppercase'),
        number: document.getElementById('number'),
        special: document.getElementById('special')
    };

    let strength = 0; // Strength level

    // Check password length
    if (password.length >= 8) {
        strength++;
        requirements.length.classList.remove('invalid');
        requirements.length.classList.add('valid');
    } else {
        requirements.length.classList.remove('valid');
        requirements.length.classList.add('invalid');
    }

    // Check for uppercase letters
    if (/[A-Z]/.test(password)) {
        strength++;
        requirements.uppercase.classList.remove('invalid');
        requirements.uppercase.classList.add('valid');
    } else {
        requirements.uppercase.classList.remove('valid');
        requirements.uppercase.classList.add('invalid');
    }

    // Check for numbers
    if (/[0-9]/.test(password)) {
        strength++;
        requirements.number.classList.remove('invalid');
        requirements.number.classList.add('valid');
    } else {
        requirements.number.classList.remove('valid');
        requirements.number.classList.add('invalid');
    }

    // Check for special characters
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        strength++;
        requirements.special.classList.remove('invalid');
        requirements.special.classList.add('valid');
    } else {
        requirements.special.classList.remove('valid');
        requirements.special.classList.add('invalid');
    }

    // Update the strength bar width and color based on strength level
    switch (strength) {
        case 0:
        case 1:
            strengthBar.style.width = '33%';
            strengthBar.style.backgroundColor = 'red'; // Red
            break;
        case 2:
            strengthBar.style.width = '66%';
            strengthBar.style.backgroundColor = 'orange'; // Orange
            break;
        case 3:
            strengthBar.style.width = '100%';
            strengthBar.style.backgroundColor = 'lightgreen'; // Light Green
            break;
        case 4:
            strengthBar.style.width = '100%';
            strengthBar.style.backgroundColor = 'green'; // Dark Green
            break;
        default:
            strengthBar.style.width = '0%';
            strengthBar.style.backgroundColor = '#ddd'; // Default gray
            break;
    }
}

// Function to validate password match
function validatePassword() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}

// Function to check confirm password on input
document.getElementById('confirm-password').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    
    if (password !== confirmPassword) {
        this.setCustomValidity("Passwords do not match.");
        this.reportValidity(); // Display the message
    } else {
        this.setCustomValidity(""); // Clear the message
    }
});

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

// Function to show login modal
function showLogin() {
    document.querySelector('.login-container').style.display = 'flex';
    document.querySelector('.register-container').style.display = 'none'; // Hide register if showing login
}

// Function to show register modal
function showRegister() {
    document.querySelector('.register-container').style.display = 'flex';
    document.querySelector('.login-container').style.display = 'none'; // Hide login if showing register
}

// Placeholder for login function
function login() {
    const username = document.getElementById('login-username').value;
    const password = document.getElementById('login-password').value;

    // Replace with your login logic
    alert(`Logging in with ${username}`);
}

// Placeholder for registration function
function register() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Replace with your registration logic
    alert(`Registering ${username}`);
}

// Load cart on page load
document.addEventListener('DOMContentLoaded', updateCart);
