<?php
require_once( "Lib/lib.php" );
session_start();

if (!isset($_SESSION['lang'])) {
    require_once( "lingEN.php" );
}
?>
<!doctype html>
<html lang="en">

    <style>
        body{
            width: 100%;
            height: 130vh;
            background: url(assets/images/back_neymar.jpg) no-repeat 50% 50%;
            background-size: cover;
        }

    </style>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/menu.css">
        <title>Football Moments</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" style="color:white" href="index.php">
                <img src="assets/images/logo.png"width="30" height="30" class="logo" alt="">
                Football Moments
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
        <div class="container">
            <ul>
                <li><a href="lingEN.php"><?php echo $_SESSION["lang"]["english"]; ?></a></li>
                <li><a href="lingFR.php"><?php echo $_SESSION["lang"]["french"]; ?></a></li>
                <li><a href="lingPT.php"><?php echo $_SESSION["lang"]["portuguese"]; ?></a></li>
            </ul>  
        </div>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    </body>

</html>