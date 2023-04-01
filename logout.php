<!--logout.php-->
<!--Author: Alexis Demetriou (G20970098)-->
<!--Email: ADemetriou5@uclan.ac.uk-->

<?php
    // Start the session
    session_start();

    // Destroy the session data
    session_destroy();

    // Redirect the user to the index page
    header("Location: index.php");

    // Exit the script to prevent further execution
    exit();
?>