<?php
// Initialize the session
session_start();

// Include config file
require_once "../login/config.php";

$sql = "DELETE FROM accommodations WHERE id = '$_GET[id]'";
    if(mysqli_query($link, $sql))
        header("refresh:1; url=show_accommodation.php");
    else
        echo "Not Deleted!";


