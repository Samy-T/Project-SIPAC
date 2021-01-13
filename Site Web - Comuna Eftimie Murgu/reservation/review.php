<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accommodation</title>
    <link rel="icon" href="../images/Stema-EM.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../css/logged.css" type="text/css">
    <style>
        .title {
            text-align: center;
            margin-top:1em;
            font-family: Berlin Sans FB;
        }
        .image {
            width: 50em;
            padding: 3em;
            text-align:center;
        }

    </style>
</head>

<?php
// Initialize the session
session_start();

// Include config file
require_once "../login/config.php";

$sql = "SELECT accommodation_name, address, email, phone_number, no_of_persons, price, manager, image FROM accommodations WHERE id='$_GET[id]'";
    if(mysqli_query($link, $sql))
        header("url=view.php");
    else
        echo "Not Info Added!";

    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];
        $image_src = "../upload/".$image;
        echo "<h1 class = 'title'>" .$row["accommodation_name"] ."</h1>";
        echo nl2br("\n");
        echo "<div style=\"text-align: center;\"><img class='image' src=" . $image_src . " ></div>";
        echo "<div class = 'info'>Adresă: " .$row["address"];
        echo nl2br("\n");
        echo "Email: " .$row["email"];
        echo nl2br("\n");
        echo "Phone number: " .$row["phone_number"];
        echo nl2br("\n");
        echo "Number of persons available: " .$row["no_of_persons"];
        echo nl2br("\n");
        echo "Price / Night: " .$row["price"]. "</div>";
        $sql_review = "SELECT review FROM reviews WHERE id_accommodations = '$_GET[id]'";
        $result_review = mysqli_query($link, $sql_review);
        if(mysqli_num_rows($result_review) > 0) {
            while($row_review = mysqli_fetch_assoc($result_review)) {
                echo $row_review["last_name"] . " " . $row_review["first_name"] . " - " . $row_review["review"];
            }
        } else {
            echo  nl2br("\n Niciun review! \n");
            echo  nl2br("Fiți primul care spune o părerea despre aces loc!");
        }

    }

