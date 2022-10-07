<?php
session_start();
//session_destroy();

require_once( "Lib/lib.php" );
require_once ("regex.php");

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);

$serverPort = 80;

$name = webAppName();

$baseUrl = "http://" . $serverName . ":" . $serverPort;

$baseNextUrl = $baseUrl . $name;

$nextUrl = "processRegistration.php";

require_once( "defaultLang.php" );
?>

<!DOCTYPE html>
<html lang=<?php echo $_SESSION["language"]; ?>>

    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Colorlib Templates">
        <meta name="author" content="Colorlib">
        <meta name="keywords" content="Colorlib Templates">

        <!-- Title Page-->
        <title>Football Moments / <?php echo $_SESSION["lang"]["register"]; ?></title>

        <!-- Icons font CSS-->
        <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <!-- Font special for pages-->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Vendor CSS-->
        <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

        <!-- Main CSS-->
        <link href="assets/css/registo.css" rel="stylesheet" media="all">
        <script type="text/javascript" src="scripts/forms.js"></script>
    </head>

    <body>
        <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
            <div class="wrapper wrapper--w680">
                <div class="card card-4">
                    <div class="card-body">
                        <img src="assets/images/logo.png" id="logo" >
                        <h1 class="title"><?php echo $_SESSION["lang"]["register"]; ?></h1>
                        <form 
                            enctype="multipart/form-data"
                            action="captcha.php"
                            method="POST"
                            onsubmit="return FormRegistrationValidator(this, <?php echo $regexUsername ?>, <?php echo $regexPassword ?>, <?php echo $regexEmail ?>)"
                            name="FormRegistration">
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><?php echo $_SESSION["lang"]["username"]; ?></label>
                                        <input class="input--style-4" type="text" name="username" maxlength="5" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label"><?php echo $_SESSION["lang"]["password"]; ?></label>
                                        <input class="input--style-4" type="password" name="password" maxlength="8" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group">
                                        <label class="label">Email</label>
                                        <input class="input--style-4" type="email" name="email" maxlength="128" required>
                                    </div>
                                </div>
                            </div>
                            <p class="label"><?php echo $_SESSION["lang"]["chooseAvatar"]; ?></p>
                            <label>
                                <input type="radio" id="img1" name="avatar" value="img1" required>
                                <img class="user-image" src="https://bootdey.com/img/Content/avatar/avatar1.png">
                            </label>
                              <label>
                                <input type="radio" id="img2" name="avatar" value="img2" required>
                                <img class="user-image" src="https://bootdey.com/img/Content/avatar/avatar2.png">
                            </label>
                            <label>
                                <input type="radio" id="img3" name="avatar" value="img3" required>
                                <img class="user-image" src="https://bootdey.com/img/Content/avatar/avatar3.png">
                            </label>
                            <label>
                                <input type="radio" id="img4" name="avatar" value="img4" required>
                                <img class="user-image" src="https://bootdey.com/img/Content/avatar/avatar4.png">
                            </label>
                            <label>
                                <input type="radio" id="img5" name="avatar" value="img5" required>
                                <img class="user-image" src="https://bootdey.com/img/Content/avatar/avatar5.png">
                            </label>
                              <label>
                                <input type="radio" id="img6" name="avatar" value="img6" required>
                                <img class="user-image" src="https://bootdey.com/img/Content/avatar/avatar6.png">
                            </label>
                            <label>
                                <input type="radio" id="img7" name="avatar" value="img7" required>
                                <img class="user-image" src="https://bootdey.com/img/Content/avatar/avatar7.png">
                            </label>
                            <label>
                                <input type="radio" id="img8" name="avatar" value="img8" required>
                                <img class="user-image" src="https://bootdey.com/img/Content/avatar/avatar8.png">
                            </label>
                            <div class="p-t-15">
                                <button class="btn btn--radius-2 btn--red" type="submit"><?php echo $_SESSION["lang"]["submit"]; ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jquery JS-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <!-- Vendor JS-->
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/datepicker/moment.min.js"></script>
        <script src="vendor/datepicker/daterangepicker.js"></script>

        <!-- Main JS-->
        <script src="js/global.js"></script>

    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->