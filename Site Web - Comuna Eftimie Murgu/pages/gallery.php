<?php

// Initialize the session
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <link rel="icon" href="../images/Stema-EM.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/user.css" type="text/css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

</head>
<body>
    <div id="back">
        <a href="../welcome.php">Înapoi la pagina principală</a>
    </div>
    <br>
    <h1 align="center">Bine ai venit, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
    <h4 style="text-align: center">Please select one gallery:</h4>
    <div id="wrapper">
        <a href="gallery_settings.php?gallery=1" class="btn btn-primary btn-lg btn-block">Morile de apă</a>
        <a href="gallery_settings.php?gallery=2" class="btn btn-primary btn-lg btn-block">Muzeul satului</a>
        <a href="gallery_settings.php?gallery=3" class="btn btn-primary btn-lg btn-block">Valea Rudăriei</a>
        <a href="gallery_settings.php?gallery=4" class="btn btn-primary btn-lg btn-block">Lunea cornilor</a>
        <a href="gallery_settings.php?gallery=5" class="btn btn-primary btn-lg btn-block">Dezastru natural</a>

    </div>
</body>
</html>

