<!DOCTYPE html>
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

$review ="";
$review_err="";

$sql = "SELECT id, accommodation_name, address, email, phone_number, no_of_persons, price, manager, image FROM accommodations WHERE id='$_GET[id]'";
    if(mysqli_query($link, $sql))
        header("url=get_reservation.php");
    else
        echo "Not Info Added!";

    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];
        $image_src = "../upload/Accommodation/".$image;
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
        $sql_review = "SELECT id, username, last_name, first_name, review FROM reviews WHERE id_accommodation = '$_GET[id]'";
        $result_review = mysqli_query($link, $sql_review);
        echo "<h3>Reviews:</h3>";
        if(mysqli_num_rows($result_review) > 0) {
            while($row_review = mysqli_fetch_assoc($result_review)) {
                echo $row_review["last_name"] . " " . $row_review["first_name"] . " : " . $row_review["review"];
                if($_SESSION["type_user"] == 1) {
                    echo " - <a href=delete_review.php?id=" . $row_review["id"] . ">Șterge</a>";
                } else {
                    if($row_review["username"] == $_SESSION['username']) {
                        echo " - <a href=delete_review.php?id=" . $row_review["id"] . ">Șterge</a>";
                    }
                }
                echo nl2br("\n");
            }
            echo "<hr>";
        } else {
            echo  nl2br("\n No Reviews Added! \n");
            echo  nl2br("Be first who say about this place!");
        }
    }

    echo "<form action='' method=\"post\">";
        echo "<div class=\"form-group (!empty($review)) ? 'has-error' : ''\">";
        echo "<label>How was this place?</label>";
        echo "<input type=\"text\" name='review' class='form-control' value=" .$review. ">";
        echo "<span class=\"help-block\">" .$review_err."</span>";
        //echo "<a href=\"view.php\" class=\"btn btn-primary btn-lg btn-block\">Review</a>";
        echo "<div class=\"form-group\">";
            echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Add Review\">";
        echo "</div>";
    echo "</form>";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate review
        if (empty(trim($_POST["review"]))) {
            $review_err = "Please enter a review.";
        } else {
            $review = trim($_POST["review"]);
        }

        //Get data for user
        $sql_user = "SELECT id, first_name, last_name FROM users WHERE username = '".$_SESSION['username']."'";
        $result_user = mysqli_query($link, $sql_user);
        if(mysqli_num_rows($result_user) > 0) {
            $row_user = mysqli_fetch_assoc($result_user);
        }

        if(empty($review_err)) {
            $sql_review = "INSERT INTO reviews (username, id_accommodation, last_name, first_name, review) VALUES (?, ?, ?, ?, ?)";
            if($stmt = mysqli_prepare($link, $sql_review)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sdsss", $param_username, $param_id_accommodation, $param_last_name, $param_first_name, $param_review);
                // Set parameters
                $param_username = $_SESSION['username'];
                $param_id_accommodation = $row['id'];
                $param_last_name = $row_user['last_name'];
                $param_first_name = $row_user['first_name'];
                $param_review = $review;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect to login page
                    header("location: get_reservation.php");
            }
        } else {
            echo "Something went wrong. Please try again later.";
        }
        // Close statement
       // mysqli_stmt_close($stmt);
        }
    }


