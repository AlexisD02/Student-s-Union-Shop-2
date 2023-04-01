<!--error_page.php-->
<!--Author: Alexis Demetriou (G20970098)-->
<!--Email: ADemetriou5@uclan.ac.uk-->

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Error - Page Not Found</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="error_page">

    <div class="error_container"> <!-- Create a container for the error message -->
        <h1 class="error_heading">Oops, we couldn't find what you were looking for!</h1> <!-- Display the error heading -->
        <p class="error_message">The page you requested could not be found. Maybe it has been moved, deleted, or never existed in the first place.</p> <!-- Display the error message -->
        <p class="error_message">In the meantime, why don't you try one of these popular pages:</p> <!-- Suggest some popular pages -->
        <div class="error_links"> <!-- Create a container for the popular page links -->
            <a href="index.php">Home</a> <!-- Display a link to the home page -->
            <a href="products.php">Products</a> <!-- Display a link to the products page -->
            <a href="cart.php">Cart</a> <!-- Display a link to the cart page -->
            <?php
            if (!isset($_SESSION['user_id'])) { // Check if the user is not logged in
                echo '<a href="login.php">Login</a>'; // Display a link to the login page
                echo '<a href="signup.php">Sign Up</a>'; // Display a link to the sign-up page
            }
            else { // If the user is logged in
                echo '<a href="my_orders.php">My Orders</a>'; // Display a link to the user's orders page
            }
            ?>
        </div>
    </div>

</body>
</html>
