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
</head>
<body>
<div id="back">
    <a href="../users/user.php">Back</a>
</div>
    <?php
    if($_SESSION["type_user"] == 1) {
        $sql = "SELECT id, accommodation_name, address, email, phone_number, no_of_persons, price, manager FROM accommodations";
    } else {
        $sql = "SELECT id, accommodation_name, address, email, phone_number, no_of_persons, price, manager FROM accommodations WHERE manager = '".$_SESSION['username']."'";
    }
    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) > 0) {
        echo "<h1 align='center'>Locuri de cazare oferite</h1>";
        echo "<br>";
        echo "<table class=\"table\">";
        echo "<thead class=\"thead-dark\">";
        echo "<tr>";
        echo "<th scope=\"col\">#</th>";
        echo "<th scope=\"col\">Nume</th>";
        echo "<th scope=\"col\">Adresă</th>";
        echo "<th scope=\"col\">Email</th>";
        echo "<th scope=\"col\">Număr telefon</th>";
        echo "<th scope=\"col\">Locuri de cazare</th>";
        echo "<th scope=\"col\">Preț / Noapte</th>";

        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><th scope=\"row\">". $row["id"]."</th>
                      <th scope=\"row\">" . $row["accommodation_name"] . "</th>
                      <th scope=\"row\">" . $row["address"] . "</th>
                      <th scope=\"row\">" . $row["email"] . "</th>
                      <th scope=\"row\">" . $row["phone_number"] . "</th>
                      <th scope=\"row\">". $row["no_of_persons"] ."</th>
                      <th scope=\"row\">". $row["price"] ."</th>";
                      if ($_SESSION["type_user"] == 1) {
                          echo "<th scope=\"row\"><a href=delete.php?id=". $row["id"] .">Șterge</a></th></tr>";
                      } else {
                          echo "</tr>";
                      }
        }
    } else {
        echo "<h2 align='center'>Nu ați adăugat nici o cazare.</h2>";
    }

    mysqli_close($link);
    ?>
</body>
</html>