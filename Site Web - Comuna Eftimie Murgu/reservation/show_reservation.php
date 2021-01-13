<?php
    // Initialize the session
    session_start();

    // Include config file
    require_once "../login/config.php";
    ?>

<!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accommodation</title>
    <link rel="icon" href="../images/Stema-EM.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../css/logged.css" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
<div id="back">
    <a href="../users/user.php">Back</a>
</div>
    <?php
    //Verify the type of user
    if($_SESSION["type_user"] == 1) {
        $sql = "SELECT id, accommodation_name, no_of_persons_reserved, check_in_date, check_in_time, check_out_date, check_out_time, price FROM reservations";

    } else {
        $sql = "SELECT id, accommodation_name, no_of_persons_reserved, check_in_date, check_in_time, check_out_date, check_out_time, price FROM reservations WHERE username_client = '".$_SESSION['username']."'";
    }
    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) > 0) {
        echo "<h1 align='center'>Rezervări</h1>";
        echo "<br>";
        echo "<table class=\"table table-dark\">";
        echo "<thead class=\"thead-light\">";
        echo "<tr>";
        echo "<th scope=\"col\">#</th>";
        echo "<th scope=\"col\">Locație</th>";
        echo "<th scope=\"col\">Persoane</th>";
        echo "<th scope=\"col\">Check-in date</th>";
        echo "<th scope=\"col\">Check-in time</th>";
        echo "<th scope=\"col\">Check-out date</th>";
        echo "<th scope=\"col\">Check-out time</th>";
        echo "<th scope=\"col\">Preț / Noapte</th>";

        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><th scope=\"row\">" . $row["id"] . "</th>
                  <th scope=\"row\">" . $row["accommodation_name"] . "</th>
                  <th scope=\"row\">" . $row["no_of_persons_reserved"] . "</th>
                  <th scope=\"row\">" . $row["check_in_date"] . "</th>
                  <th scope=\"row\">" . $row["check_in_time"] . "</th>
                  <th scope=\"row\">" . $row["check_out_date"] . "</th>
                  <th scope=\"row\">" . $row["check_out_time"] . "</th>
                  <th scope=\"row\">" . $row["price"] . "</th>";
            if ($_SESSION["type_user"] == 1) {
                echo "<th scope=\"row\"><a href=delete.php?id=" . $row["id"] . ">Șterge</a></th></tr>";
            } else {
                echo "</tr>";
            }
        }
    } else {
        echo "<h2 align='center'>Nu ați făcut nici o rezervare.</h2>";
    }
    mysqli_close($link);
    ?>

</body>
</html>