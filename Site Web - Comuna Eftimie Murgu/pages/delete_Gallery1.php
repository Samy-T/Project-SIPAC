<?php
// Initialize the session
session_start();

// Include config file
require_once "../login/config.php";

$sql1 = "SELECT image FROM morile_de_apa_gallery WHERE id = '$_GET[id]'";
    $result = mysqli_query($link, $sql1);
    $row = mysqli_fetch_assoc($result);
    unlink("../upload/Gallery1/$row[image]");

$sql = "DELETE FROM morile_de_apa_gallery WHERE id = '$_GET[id]'";
    if(mysqli_query($link, $sql))
        header("refresh:1; url=gallery.php");
    else
        echo "Not Deleted!";

