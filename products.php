<!--products.php-->
<!--Author: Alexis Demetriou (G20970098)-->
<!--Email: ADemetriou5@uclan.ac.uk-->

<?php session_start(); ?>
<!DOCTYPE html> <!-- It is an "information" to the browser about what document type to expect-->
<html lang="en"> <!--Declare the language of the Web page-->
<head> <!--Element <head> is a container for metadata (data about data)-->
    <title>Products</title> <!--Title of the page-->
    <meta charset="UTF-8"> <!--Specifies the character encoding for the HTML document.
    The HTML5 specification encourages web developers to use the UTF-8 character set!-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Responsive web design-->
    <link rel="stylesheet" href="style.css" /> <!--Link CSS to HTML – Stylesheet File Linking-->
</head>
<body>

<a id="top"></a> <!--Element <a> creates an anchor on the page named top-->

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

<main class="content2"> <!--Elements specifies the main content of a page-->

    <!-- Search bar -->
    <div class="search-container">
        <form class="search-form" method="POST" action="products.php">
            <input type="text" name="searchTerm" placeholder="Search for products">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Filter options -->
    <p class="filters">Products:
        <a href="products.php?type=all" class="<?php echo (!isset($_GET['type']) || $_GET['type'] === 'all') ? 'selected' : 'not_selected'; ?>">All</a>
        <a href="products.php?type=UClan Logo Tshirt" class="<?php echo (isset($_GET['type']) && $_GET['type'] === 'UClan Logo Tshirt') ? 'selected' : 'not_selected'; ?>">T-shirts</a>
        <a href="products.php?type=UClan Hoodie" class="<?php echo (isset($_GET['type']) && $_GET['type'] === 'UClan Hoodie') ? 'selected' : 'not_selected'; ?>">Hoodies</a>
        <a href="products.php?type=UCLan Logo Jumper" class="<?php echo (isset($_GET['type']) && $_GET['type'] === 'UCLan Logo Jumper') ? 'selected' : 'not_selected'; ?>">Jumpers</a>
    </p>

    <!-- Product cards -->
    <div class="clearfix" id="hoodies">

        <?php
            // Connect to database
            include "connect.php";

            // Get search term from form submission
            $searchTerm = isset($_POST['searchTerm']) ? mysqli_real_escape_string($connection, $_POST['searchTerm']) : '';

            // Function to build a LIKE query for searching
            function buildLikeQuery($field, $searchWords) {
                $likeQuery = "";
                foreach ($searchWords as $word) {
                    if ($likeQuery !== "") {
                        $likeQuery .= " AND ";
                    }
                    $likeQuery .= "$field LIKE '%$word%'";
                }
                return $likeQuery;
            }

            // Split search term into individual words
            $searchWords = explode(' ', $searchTerm);

            // Build query based on filter and search term
            if (isset($_GET['type'])) { //If filter is set
                $productType = mysqli_real_escape_string($connection, $_GET['type']);
                if ($productType === 'all') { //If filter is set to show all products
                    $query = "SELECT * FROM tbl_products ORDER BY product_id";
                }
                else { //If filter is set to show specific product type
                    $query = "SELECT * FROM tbl_products WHERE product_type='$productType' ORDER BY product_id";
                }
            }
            else { //If filter is not set
                if ($searchTerm !== '') { //If search term is entered
                    $query = "SELECT * FROM tbl_products WHERE (" . buildLikeQuery('product_title', $searchWords) . " OR " . buildLikeQuery('product_desc', $searchWords) . ") ORDER BY product_id"; //Search for products that match search term
                }
                else { //If search term is not entered
                    $query = "SELECT * FROM tbl_products ORDER BY product_id"; //Show all products
                }
            }

            // Execute query and loop through results to display product cards
            $result = mysqli_query($connection, $query);
            function containsSearchWords($text, $searchWords) {
                foreach ($searchWords as $word) {
                    if (stripos($text, $word) !== false) {
                        return true;
                    }
                }
                return false;
            }

            while ($row = mysqli_fetch_assoc($result)) {
                // Skip product if it doesn't match search term
                if ($searchTerm !== '' && !containsSearchWords($row['product_title'], $searchWords) && !containsSearchWords($row['product_desc'], $searchWords)) {
                    continue;
                }


                echo "<div class='card'>";
                echo "<a href='item.php?product_id=" . $row['product_id'] . "'><img class='image' alt='" . $row['product_title'] . "' src='" . $row['product_image'] . "'></a>";
                echo "<div class='products_info'>";
                echo "<h2 class='heading'>" . $row['product_title'] . "</h2>";
                echo "<p class='description'>" . $row['product_desc'] . " <a class='link_color' href='item.php?product_id=" . $row['product_id'] . "' >Read More</a></p>";
                echo "<p class='price'>" . $row['product_price'] . "</p>";
                echo "<p class='button'><button onclick='addToCart(" . json_encode($row) .")'>Buy</button></p>";
                echo "</div></div>";
            }
        ?>

    </div>

    <a id="top_link" href="#top">top</a> <!--Element <a> link to the very start of the page-->

    <div class="clearfix"></div> <!--Element clears floated content within a container by adding a clearfix utility-->
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

<script src="js/item.js"></script> <!-- Attribute <script> specifies the URL of an external script file-->
<script src="js/functions.js"></script> <!--Attribute <script> specifies the URL of an external script file-->

</body>
</html>
