<?php
// Initialize the session
session_start();

// Include config file
require_once "../login/config.php";

$sql1 = "SELECT image FROM lunea_cornilor_gallery WHERE id = '$_GET[id]'";
$result = mysqli_query($link, $sql1);
$row = mysqli_fetch_assoc($result);
unlink("../upload/Gallery4/$row[image]");

$sql = "DELETE FROM lunea_cornilor_gallery WHERE id = '$_GET[id]'";
if(mysqli_query($link, $sql))
    header("refresh:1; url=gallery.php");
else
    echo "Not Deleted!";