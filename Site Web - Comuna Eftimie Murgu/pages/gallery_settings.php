<?php
// Initialize the session
session_start();

// Include config file
require_once "../login/config.php";

$photo = "";
$photo_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //Add Photo
    if (isset($_POST['add'])) {
        $photo = $_FILES['photo']['name'];
        if($_GET['gallery'] == 1)
            $target_dir = "../upload/Gallery1/";
        if($_GET['gallery'] == 2)
            $target_dir = "../upload/Gallery2/";
        if($_GET['gallery'] == 3)
            $target_dir = "../upload/Gallery3/";
        if($_GET['gallery'] == 4)
            $target_dir = "../upload/Gallery4/";
        if($_GET['gallery'] == 5)
            $target_dir = "../upload/Gallery5/";

        $target_file = $target_dir . basename($_FILES["photo"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType, $extensions_arr) ){
            // Upload file
            move_uploaded_file($_FILES['photo']['tmp_name'], $target_dir.$photo);
        } else {
            $photo_err = "Please upload a picture";
        }
    }

    if(empty($photo_err) ) {
    // Prepare an insert PHOTO in specific Gallery
        if($_GET['gallery'] == 1)
            $sql = "INSERT INTO morile_de_apa_gallery (image) VALUES (?)";
        if($_GET['gallery'] == 2)
            $sql = "INSERT INTO muzeul_satului_gallery (image) VALUES (?)";
        if($_GET['gallery'] == 3)
            $sql = "INSERT INTO valea_rudariei_gallery (image) VALUES (?)";
        if($_GET['gallery'] == 4)
            $sql = "INSERT INTO lunea_cornilor_gallery (image) VALUES (?)";
        if($_GET['gallery'] == 5)
            $sql = "INSERT INTO dezastru_natural_gallery (image) VALUES (?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_photo);
            $param_photo = $photo;

            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                 header("location: gallery.php");
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
    <title>Gallery Settings</title>
    <link rel="icon" href="../images/Stema-EM.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../css/login.css" type="text/css">
    <style>
        .image {
            width:10em;
        }
    </style>
</head>
<body>
<div id="back">
    <a href="gallery.php">Back</a>
</div>
<div id="wrapper">
    <h2>Add a photo to Gallery
    <?php
        if($_GET['gallery'] == 1)
            echo "Morile de apă";
        if($_GET['gallery'] == 2)
            echo "Muzeul satului";
        if($_GET['gallery'] == 3)
            echo "Valea Rudăriei";
        if($_GET['gallery'] == 4)
            echo "Lunea cornilor";
        if($_GET['gallery'] == 5)
            echo "Dezastru natural";
    ?></h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]). '?gallery='.$_GET['gallery']; ?>" method="post" enctype='multipart/form-data'>
        <div class="form-group <?php echo (!empty($photo_err)) ? 'has-error' : ''; ?>">
            <label>Add photo</label>
            <input type = "file", name = "photo" >
            <span class="help-block"><?php echo $photo_err; ?></span>
        </div>
        <div class="form-group">
            <input type="Submit" class="btn btn-primary" value="Add" name="add">
        </div>
    </form>
    <div>
        <?php
        //Remove photo
        echo "<h1 align='center'>Galerie:</h1>";
        echo "<br>";
        echo "<table class=\"table\">";
        echo "<thead class=\"thead-dark\">";
        echo "<tr>";
        echo "<th scope=\"col\">#</th>";
        echo "<th scope=\"col\">Image</th>";
        echo "<th scope=\"col\">Remove</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        if($_GET['gallery'] == 1) {
                $sql_photo = "SELECT id, image FROM morile_de_apa_gallery";
                $result_photo = mysqli_query($link, $sql_photo);
                if(mysqli_num_rows($result_photo) > 0) {
                    while ($row = mysqli_fetch_assoc($result_photo)) {
                        echo "<tr><th scope=\"row\">" .$row['id']. "</th>
                                  <th><img class = 'image' src= ../upload/Gallery1/". $row['image'] ."></th>
                                  <th><a href=delete_Gallery1.php?id=". $row["id"] .">Șterge</a></th></tr>";
                    }
                }
        }
        if($_GET['gallery'] == 2) {
            $sql_photo = "SELECT id, image FROM muzeul_satului_gallery";
            $result_photo = mysqli_query($link, $sql_photo);
            if(mysqli_num_rows($result_photo) > 0) {
                while ($row = mysqli_fetch_assoc($result_photo)) {
                    echo "<tr><th scope=\"row\">" .$row['id']. "</th>
                                  <th><img class = 'image' src= ../upload/Gallery2/". $row['image'] ."></th>
                                  <th><a href=delete_Gallery2.php?id=". $row["id"] .">Șterge</a></th></tr>";
                }
            }
        }
        if($_GET['gallery'] == 3) {
            $sql_photo = "SELECT id, image FROM valea_rudariei_gallery";
            $result_photo = mysqli_query($link, $sql_photo);
            if(mysqli_num_rows($result_photo) > 0) {
                while ($row = mysqli_fetch_assoc($result_photo)) {
                    echo "<tr><th scope=\"row\">" .$row['id']. "</th>
                                  <th><img class = 'image' src= ../upload/Gallery3/". $row['image'] ."></th>
                                  <th><a href=delete_Gallery3.php?id=". $row["id"] .">Șterge</a></th></tr>";
                }
            }
        }
        if($_GET['gallery'] == 4) {
            $sql_photo = "SELECT id, image FROM lunea_cornilor_gallery";
            $result_photo = mysqli_query($link, $sql_photo);
            if(mysqli_num_rows($result_photo) > 0) {
                while ($row = mysqli_fetch_assoc($result_photo)) {
                    echo "<tr><th scope=\"row\">" .$row['id']. "</th>
                                  <th><img class = 'image' src= ../upload/Gallery4/". $row['image'] ."></th>
                                  <th><a href=delete_Gallery4.php?id=". $row["id"] .">Șterge</a></th></tr>";
                }
            }
        }
        if($_GET['gallery'] == 5) {
            $sql_photo = "SELECT id, image FROM dezastru_natural_gallery";
            $result_photo = mysqli_query($link, $sql_photo);
            if(mysqli_num_rows($result_photo) > 0) {
                while ($row = mysqli_fetch_assoc($result_photo)) {
                    echo "<tr><th scope=\"row\">" .$row['id']. "</th>
                                  <th><img class = 'image' src= ../upload/Gallery5/". $row['image'] ."></th>
                                  <th><a href=delete_Gallery5.php?id=". $row["id"] .">Șterge</a></th></tr>";
                }
            }
        }
        echo "</tbody>";
        echo "</table>";
        ?>
    </div>


</div>
</body>
</html>
