<?php
require_once( "Lib/lib.php" );
require_once( "defaultLang.php" );
?>
<!doctype html>
<html lang=<?php echo $_SESSION["language"]; ?>>

    <style>
        body{
            width: 100%;
            height: 100vh;
            background: url(assets/images/background.jpg) no-repeat 50% 50%;
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
            <a class="navbar-brand" style="color:white" href="#">
                <img src="assets/images/logo.png"width="30" height="30" class="logo" alt="">
                Football Moments
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
        <div class="container">
            <ul>
                <li><a href="view.php"> <?php echo $_SESSION["lang"]["seeAllContent"]; ?></a></li>
<?php if (isset($_SESSION['username'])) { ?>
                    <li><a href="viewMyContent.php"> <?php echo $_SESSION["lang"]["seeMyContent"]; ?></a></li>
                    <li><a href="perfil.php"> <?php echo $_SESSION["lang"]["myProfille"]; ?></a></li>
                    <li><a href="chooseLang.php"> <?php echo $_SESSION["lang"]["language"]; ?></a></li>
                    <li><a href="logOut.php"> <?php echo $_SESSION["lang"]["logOut"]; ?></a></li>
<?php } ?>
                <?php if (!isset($_SESSION['username'])) { ?>
                    <li><a href="logIn.php"> <?php echo $_SESSION["lang"]["logIn"]; ?></a></li>
                    <li><a href="registration.php"> <?php echo $_SESSION["lang"]["register"]; ?></a></li>
<?php } ?>
            </ul>

        </div>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    </body>

</html>