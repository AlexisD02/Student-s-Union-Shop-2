<!--index.php-->
<!--Author: Alexis Demetriou (G20970098)-->
<!--Email: ADemetriou5@uclan.ac.uk-->

<?php session_start(); ?>
<!DOCTYPE html> <!-- It is an "information" to the browser about what document type to expect-->
<html lang="en"> <!--Declare the language of the Web page-->
<head> <!--Element <head> is a container for metadata (data about data)-->
    <title>Home</title> <!--Title of the page-->
    <meta charset="UTF-8"> <!--Specifies the character encoding for the HTML document.
    The HTML5 specification encourages web developers to use the UTF-8 character set!-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Responsive web design-->
    <link rel="stylesheet" href="style.css" /> <!--Link CSS to HTML – Stylesheet File Linking-->
</head>
<body>

<header class="header"> <!--Element represents a container for introductory content-->
    <img id="image1" src="images/uclan.png" alt="UCLan Logo"> <!--Element is used to embed an image in an HTML page-->
    <h2>Student Shop</h2> <!--Element is used to define HTML heading-->
    <div id="header-right"> <!--Element is used as a container for HTML elements - which is then styled with CSS or
        manipulated with JavaScript-->
        <!--Elements <a> defines a hyperlink, which is used to link from one page to another-->
        <a class="tags" href="index.php">Home</a>
        <a class="tags" href="products.php">Products</a>
        <a class="tags" href="cart.php">Cart</a>
        <?php
        // Check if the user is logged in, if yes, display the "My Orders" and "Logout" links
        if (isset($_SESSION['user_id'])) {
            echo '<a class="tags" href="my_orders.php">My Orders</a>';
            echo '<a class="tags" href="logout.php">Logout</a>';
        }
        // If the user is not logged in, display the "Login" and "Sign Up" links
        else {
            echo '<a class="tags" href="login.php">Login</a>';
            echo '<a class="tags" href="signup.php">Sign Up</a>';
        }
        ?>
        <!-- The above PHP code checks if the user is logged in or not and displays the appropriate links accordingly. -->
        <!-- If the user is logged in, it shows the "My Orders" and "Logout" links. -->
        <!-- If the user is not logged in, it shows the "Login" and "Sign Up" links. -->
    </div>

    <!--Elements <a> defines a hyperlink hamburger menu-->
    <a class="click_menu" onclick='click_button_action()'>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </a>
</header>

<main> <!--Elements specifies the main content of a document-->
    <div class="content">
        <h1 class="h1_title">Offers</h1>
        <?php
        include 'connect.php';

        // Query to select all offers from the database, ordered by offer_title
        $query = "SELECT * FROM tbl_offers ORDER BY offer_title";
        $result = mysqli_query($connection, $query);

        // Create a container for the offers
        echo "<div class='card_container'>";

        // Loop through the result and display each offer in a card
        while ($row = mysqli_fetch_assoc($result)) {
            // Create a card for each offer
            echo "<div class='card_offer_index'>";
            // Display the offer title in a heading
            echo "<div class='card_title_index'><h2>" . $row["offer_title"] . "</h2></div>";
            // Display the offer description
            echo "<div class='card_description_index'>" . $row["offer_dec"] . "</div>";
            echo "</div>";
        }

        echo "</div>";
        ?>
        <div class="clearfix"></div>
        <h1 class="h1_title">Where opportunity creates success</h1> <!--Element is used to define HTML heading-->
        <p>Every student at The University of Central Lancashire is automatically a member of the Student's Union. We're here to make life better for students - inspiring you to succeed and achieve your goals.</p>
        <p>Everything you need to know about UCLan Student's Union. Your membership starts here.</p>  <!--Element defines a paragraph-->
        <h2>Together</h2>
        <div class="container">
            <!--Element <iframe> is used to embed YouTube video within the current HTML document-->
            <iframe class="responsive-iframe" src="https://www.youtube.com/embed/xTvk2OCMyWE"></iframe>
        </div>
        <h2>Join our global community</h2>
        <div class="container">
            <iframe class="responsive-iframe" src="https://www.youtube.com/embed/i2CRunZv9CU"></iframe>
        </div>
    </div>
</main>

<footer class="footer"> <!--Element defines a footer for a document-->
    <div class="row"> <!--Element is used as a container for HTML elements - which is then styled with CSS-->
        <div class="column left"> <!--Element is used as a container for HTML elements - which is then styled with CSS-->
            <h3>Links</h3>
            <p><a href="https://www.uclansu.co.uk/">Students' Union</a></p>
        </div>
        <div class="column middle"> <!--Element is used as a container for HTML elements - which is then styled with CSS-->
            <h3>Contact</h3>
            <p>Email: suinformation@uclan.ac.uk</p>
            <p>Phone: 01772 89 3000</p>
        </div>
        <div class="column right"> <!--Element is used as a container for HTML elements - which is then styled with CSS-->
            <h3>Location</h3>
            <p>University of Central Lancashire Students' Union.<br>
                Fylde Road, Preston. PR1 7BY<br>
                Registered in England<br>
                Company Number: 7623917<br>
                Registered Charity Number: 1142616</p>
        </div>
    </div>
</footer>

<script src="js/functions.js"></script>  <!--Attribute <script> specifies the URL of an external script file-->

</body>
</html>
