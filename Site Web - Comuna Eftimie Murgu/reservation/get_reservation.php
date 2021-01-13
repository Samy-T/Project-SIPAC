<?php
// Initialize the session
session_start();

// Include config file
require_once "../login/config.php";

// Define variables and initialize with empty values
$id_accommodation = $no_of_persons_reserved = $check_in_date = $check_in_time = $check_out_date = $check_out_time = "";
$id_accommodation_err = $no_of_persons_reserved_err = $check_in_date_err = $check_in_time_err = $check_out_date_err = $check_out_time_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate id_accommodation
    if(empty(trim($_POST["id_accommodation"]))) {
        $id_accommodation_err = "Please enter the accommodation id which do you want to get reservation.";
    } else {
        $id_accommodation = trim($_POST["id_accommodation"]);

        //Get number of tenants
        $sql_accommodation = "SELECT id, accommodation_name, address, email, phone_number, no_of_persons, price, manager FROM accommodations WHERE id = trim($_POST[id_accommodation])";
        $result_accommodation = mysqli_query($link, $sql_accommodation);
        if(mysqli_num_rows($result_accommodation) > 0) {
            $row_accommodation = mysqli_fetch_assoc($result_accommodation);
        }

        //Get data for user
        $sql_user = "SELECT id, first_name, last_name, email FROM users WHERE username = '".$_SESSION['username']."'";
        $result_user = mysqli_query($link, $sql_user);
        if(mysqli_num_rows($result_user) > 0) {
            $row_user = mysqli_fetch_assoc($result_user);
        }

        // Validate number of persons
        if (empty(trim($_POST["no_of_persons_reserved"]))) {
            $no_of_persons_reserved_err = "Please enter the number of persons.";
        } elseif(trim($_POST["no_of_persons_reserved"]) > $row_accommodation["no_of_persons"]) {
            $no_of_persons_reserved_err = "The number maxim of persons for accommodation selected is: $row_accommodation[no_of_persons]";
        } else {
            $no_of_persons_reserved = trim($_POST["no_of_persons_reserved"]);
            $rest_no_of_persons = $row_accommodation['no_of_persons'] - trim($_POST["no_of_persons_reserved"]);
            echo $rest_no_of_persons;
            $sql_update = "UPDATE accommodations
                            SET no_of_persons = $rest_no_of_persons
                            WHERE id = $id_accommodation";
            if (mysqli_query($link, $sql_update)) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . mysqli_error($link);
            }
        }
    }

    //Verify Check-in date
    if(empty(trim($_POST["check_in_date"]))) {
        $check_in_date_err = "Please enter the date when you plan to arrive.";
    } else {
        $check_in_date = trim($_POST["check_in_date"]);
    }

    //Verify Check-in time
    if(empty(trim($_POST["check_in_time"]))) {
        $check_in_time_err = "Please enter the time when you plan to arrive.";
    } else {
        $check_in_time = trim($_POST["check_in_time"]);
    }

    //Verify Check-out date
    if(empty(trim($_POST["check_out_date"]))) {
        $check_out_date_err = "Please enter the date when you plan to leave.";
    } else {
        $check_out_date = trim($_POST["check_out_date"]);
    }

    //Verify Check-out time
    if(empty(trim($_POST["check_out_time"]))) {
        $check_out_time_err = "Please enter the date when you plan to leave.";
    } else {
        $check_out_time = trim($_POST["check_out_time"]);
    }

    // Check input errors before inserting in database
    if(empty($id_accommodation_err) && empty($no_of_persons_reserved_err) && empty($check_in_date_err) && empty($check_in_time_err) && empty($check_out_date_err) && empty($check_out_time_err)) {
        $sql_insert = "INSERT INTO reservations (first_name_client, last_name_client, accommodation_name, no_of_persons_reserved, check_in_date, check_in_time, check_out_date, check_out_time, price, username_client) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql_insert)) {
            echo "\nMerge\n";
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssissssds", $param_first_name_client, $param_last_name_client,  $param_accommodation_name, $param_no_of_persons_reserved, $param_check_in_date, $param_check_in_time, $param_check_out_date, $param_check_out_time, $param_price, $param_username_client);
            // Set parameters
            $param_first_name_client = $row_user['first_name'];
            $param_last_name_client = $row_user['last_name'];
            $param_accommodation_name = $row_accommodation['accommodation_name'];
            $param_no_of_persons_reserved = $no_of_persons_reserved;
            $param_check_in_date = $check_in_date;
            $param_check_in_time = $check_in_time;
            $param_check_out_date = $check_out_date;
            $param_check_out_time = $check_out_time;
            $param_price = $row_accommodation['price'];
            $param_username_client = $_SESSION['username'];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: ../login/login.php");
            }
        } else {
            echo "Something went wrong. Please try again later.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}
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
<div id="wrapper">
    <?php
    $sql = "SELECT id, accommodation_name, address, email, phone_number, no_of_persons, price FROM accommodations";
    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) > 0) {
        echo "<h2 align='center'>Locuri de cazare</h2>";
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
        echo "<th scope=\"col\">Info</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                        <th scope=\"row\">". $row["id"]."</th>
                        <th scope=\"row\">" . $row["accommodation_name"] . "</th>
                        <th scope=\"row\">" . $row["address"] . "</th>
                        <th scope=\"row\">" . $row["email"] . "</th>
                        <th scope=\"row\">" . $row["phone_number"] . "</th>
                        <th scope=\"row\">". $row["no_of_persons"] ."</th>
                        <th scope=\"row\">". $row["price"] ."</th>
                        <th scope=\"row\"><a href=view.php?id=" . $row["id"] . "><button class=\"btn btn-info\">View</button></a></th>
                </tr>";
        }
    } else {
        echo "<h2 align='center'>Nu ați adăugat nici o cazare.</h2>";
    }

    mysqli_close($link);
    ?>
</div>
    <div id="form_reservation">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($id_accommodation_err)) ? 'has-error' : ''; ?>">
            <label>Numărul pensiunii (#) la care doriți să faceți rezervare:</label>
            <input type="text" name="id_accommodation" class="form-control" value="<?php echo $id_accommodation; ?>">
            <span class="help-block"><?php echo $id_accommodation_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($no_of_persons_reserved_err)) ? 'has-error' : ''; ?>">
            <label>Câte locuri doriți să rezervați?</label>
            <input type="text" name="no_of_persons_reserved" class="form-control" value="<?php echo $no_of_persons_reserved; ?>">
            <span class="help-block"><?php echo $no_of_persons_reserved_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($check_in_date_err)) ? 'has-error' : ''; ?>">
            <label>Check-in date</label>
            <input type="date" name="check_in_date" class="form-control" value="<?php echo $check_in_date; ?>">
            <span class="help-block"><?php echo $check_in_date_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($check_in_time_err)) ? 'has-error' : ''; ?>">
            <label>Check-in time</label>
            <input type="time" name="check_in_time" class="form-control" value="<?php echo $check_in_time; ?>">
            <span class="help-block"><?php echo $check_in_time_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($check_out_date_err)) ? 'has-error' : ''; ?>">
            <label>Check-out date</label>
            <input type="date" name="check_out_date" class="form-control" value="<?php echo $check_out_date; ?>">
            <span class="help-block"><?php echo $check_out_date_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($check_out_time_err)) ? 'has-error' : ''; ?>">
            <label>Check-out time</label>
            <input type="time" name="check_out_time" class="form-control" value="<?php echo $check_out_time; ?>">
            <span class="help-block"><?php echo $check_out_time_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Reserve">
        </div>
    </form>
        <div id="info">

        </div>
</div>
<script>
    function infoFunction(id) {
        sessionStorage.setItem("accommodation", id);
        window.open("../pages/info.php");
    }
</script>
</body>
</html>