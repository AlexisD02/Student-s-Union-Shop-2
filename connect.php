<!--connect.php-->
<!--Author: Alexis Demetriou (G20970098)-->
<!--Email: ADemetriou5@uclan.ac.uk-->

<?php
    // Establishing a global variable for database connection
    global $connection;
    // Connecting to the database using mysqli_connect() function and passing the required parameters
    $connection = mysqli_connect("vesta.uclan.ac.uk", "ademetriou5", "CeOAVs8b", "ademetriou5");
    // Checking if there is any error while connecting to the database using mysqli_connect_errno() function
    if (mysqli_connect_errno()) {
        echo "ERROR: could not connect to database: " . mysqli_connect_error();
    }
?>