<?php
// Initialize the session
session_start();

// Include config file
require_once "../login/config.php";

// Define variables and initialize with empty values
$accommodation_name = $address = $email = $phone_number = $no_of_persons = $price = $manager = $accommodation_photo = "";
$accommodation_name_err = $address_err = $email_err = $phone_number_err = $no_of_persons_err = $price_err = $manager_err = $accommodation_photo_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['submit'])){

        $accommodation_photo = $_FILES['accommodation_photo']['name'];
        $target_dir = "../upload/Accommodation/";
        $target_file = $target_dir . basename($_FILES["accommodation_photo"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType, $extensions_arr) ){
            // Upload file
            move_uploaded_file($_FILES['accommodation_photo']['tmp_name'], $target_dir.$accommodation_photo);
        } else {
            $accommodation_photo_err = "Please upload a picture";
        }

    }

    // Validate accommodation_name
    if(empty(trim($_POST["accommodation_name"]))) {
        $accommodation_name_err = "Please enter your accommodation name.";
    } else {
        $accommodation_name = trim($_POST["accommodation_name"]);
    }

    // Validate address
    if(empty(trim($_POST["address"]))) {
        $address_err = "Please enter your accommodation address.";
    } else {
        $address = trim($_POST["address"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate phone_number
    if(empty(trim($_POST["phone_number"]))) {
        $phone_number_err = "Please enter your phone number.";
    } elseif (!preg_match("/^[0-9]*$/",trim($_POST["phone_number"]))) {
        $phone_number_err = "Only numbers allowed.";
    } elseif(strlen(trim($_POST["phone_number"])) != 10) {
        $phone_number_err = "Phone number must have 10 numbers.";
    } else {
        $phone_number = trim($_POST["phone_number"]);
    }

    // Validate number of persons
    if(empty(trim($_POST["no_of_persons"]))) {
        $no_of_persons_err = "Please enter the number of persons.";
    } else {
        $no_of_persons = trim($_POST["no_of_persons"]);
    }

    // Validate price
    if(empty(trim($_POST["price"]))) {
        $price_err = "Please enter the price per night.";
    } else {
        $price = trim($_POST["price"]);
    }

    // Check input errors before inserting in database
    if(empty($accommodation_name_err) && empty($address_err) && empty($email_err) && empty($phone_number_err) && empty($no_of_persons_err) && empty($price_err) && empty($accommodation_photo_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO accommodations (accommodation_name, address, email, phone_number, no_of_persons, price, manager, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssssss", $param_accommodation_name, $param_address, $param_email, $param_phone_number, $param_no_of_persons, $param_price, $param_manager, $param_accommodation_photo);

                // Set parameters
                $param_accommodation_name = $accommodation_name;
                $param_address = $address;
                $param_email = $email;
                $param_phone_number = $phone_number;
                $param_no_of_persons = $no_of_persons;
                $param_price = $price;
                $param_manager = $_SESSION['username'];
                $param_accommodation_photo = $accommodation_photo;

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
    // Close connection
    mysqli_close($link);
}
?>

    <!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accommodation</title>
    <link rel="icon" href="../images/Stema-EM.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../css/login.css" type="text/css">
</head>
<body>
<div id="back">
    <a href="../users/user.php">Back</a>
</div>
<div id="wrapper">
    <h2>Add Accommodation</h2>
    <p>Please fill this form to add an accommodation.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype='multipart/form-data'>
        <div class="form-group <?php echo (!empty($accommodation_photo_err)) ? 'has-error' : ''; ?>">
            <label>Accommodation photo</label>
            <input type = "file", name = "accommodation_photo" >
            <span class="help-block"><?php echo $accommodation_photo_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($accommodation_name_err)) ? 'has-error' : ''; ?>">
            <label>Accommodation name</label>
            <input type="text" name="accommodation_name" class="form-control" value="<?php echo $accommodation_name; ?>">
            <span class="help-block"><?php echo $accommodation_name_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
            <span class="help-block"><?php echo $address_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($phone_number_err)) ? 'has-error' : ''; ?>">
            <label>Phone</label>
            <input type="text" name="phone_number" class="form-control" value="<?php echo $phone_number; ?>">
            <span class="help-block"><?php echo $phone_number_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($no_of_persons_err)) ? 'has-error' : ''; ?>">
            <label>Number of persons</label>
            <input type="text" name="no_of_persons" class="form-control" value="<?php echo $no_of_persons; ?>">
            <span class="help-block"><?php echo $no_of_persons_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
            <label>Price</label>
            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
            <span class="help-block"><?php echo $price_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit" name="submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
    </form>
</div>
</body>
    </html>
