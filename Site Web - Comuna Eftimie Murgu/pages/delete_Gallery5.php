<?php
// Initialize the session
session_start();

// Include config file
require_once "../login/config.php";

$sql1 = "SELECT image FROM dezastru_natural_gallery WHERE id = '$_GET[id]'";
$result = mysqli_query($link, $sql1);
$row = mysqli_fetch_assoc($result);
unlink("../upload/Gallery5/$row[image]");

$sql = "DELETE FROM dezastru_natural_gallery WHERE id = '$_GET[id]'";
if(mysqli_query($link, $sql))
    header("refresh:1; url=gallery.php");
else
    echo "Not Deleted!";