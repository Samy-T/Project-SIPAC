<?php
echo "
<section id=\"main-content\">
    <div id=\"container\">
        <div id=\"Content1\">
            <h1>Valea Rudăriei</h1>
                <h3>Click pe imagine pentru a mări</h3>
                <p>";
// Initialize the session
session_start();

// Include config file
require_once "../../login/config.php";
$sql = "SELECT image FROM valea_rudariei_gallery";
$result = mysqli_query($link, $sql);
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<a class=\"fancybox\" title=\"Morile de apă\" href=\"upload/Gallery3/".$row['image']." \"><img width=\"200\" height=\"150\" src=upload/Gallery3/".$row['image']. " /></a>";

    }
}
echo "</p> </div> </div> </section>";