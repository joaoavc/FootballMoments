<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 1);

require_once( "Lib/lib.php" );
require_once( "defaultLang.php" );
require_once ("translateGoogle.php");

dbConnect(ConfigFile);
$dataBaseName = $GLOBALS['configDataBase']->db;
mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

$whereClause = "WHERE `private`='0'";
if (isset($_SESSION['username'])) {
    $query = "SELECT `fileName`, `title`, `description`, `idUser`, `mimeFileName` FROM `$dataBaseName`.`images-details`";
    $authenticated = "";
} else {
    $query = "SELECT `fileName`, `title`, `description`, `idUser`, `mimeFileName` FROM `$dataBaseName`.`images-details`" . $whereClause;
    $authenticated = $_SESSION["lang"]["logOrSign"];
}


$queryResult = mysqli_query($GLOBALS['ligacao'], $query);
?>



<!doctype html>
<html lang=<?php echo $_SESSION["language"]; ?>>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Football Moments / <?php echo $_SESSION["lang"]["allContents"]; ?></title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" style="color:white" href="index.php">
                <img src="assets/images/logo.png"width="30" height="30" class="logo" alt="" >
                Football Moments
            </a>

            <div class="mr-auto"></div>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item active">
                    <a class="nav-link"style="color:white"  href="checkAuthProfile.php"><?php echo $_SESSION["lang"]["profile"]; ?> <span class="sr-only">(current)</span></a>
                </li>
                </div>
        </nav>
        <div class="Search">
            <h4><?php echo $_SESSION["lang"]["allContents"] . $authenticated; ?></h4>
        </div>
        <div class="container">
            <div class="row">
                <?php
                if ($queryResult) {
                    $result[] = array('fileName' => "", 'title' => "", 'description' => "", 'idUser' => "");
                    while ($registo = mysqli_fetch_array($queryResult)) {
                        $fileName = $registo['fileName'];
                        $title = $registo['title'];
                        $titleTras = translate($title, $_SESSION["language"]);
                        $description = $registo['description'];
                        $descriptionTras = translate($description, $_SESSION["language"]);
                        $idUser = $registo['idUser'];
                        $mimeFileName = $registo['mimeFileName'];
                        $authType = "basic";
                        $username = getUsername($idUser, $authType);
                        $img = getAvatar($idUser, $authType);
                        $avatar = getAvatarLinK($img);

                        if ($mimeFileName == "video" || $mimeFileName == "audio") {
                            ?>
                            <div class="col-md-8">
                                <div class="post-content">
                                    <video width="840" height="480" poster="BigBuckBunny.jpeg" controls >
                                        <source 
                                            src="<?php echo $fileName; ?>"
                                            type="video/mp4" />
                                    </video>                                 
                                    <div class="post-container">
                                        <img src=<?php echo $avatar; ?> alt="user" class="profile-photo-md pull-left">
                                        <div class="post-detail">
                                            <div class="user-info">
                                                <h5><a href="timeline.html" class="profile-link"><?php echo $username; ?></a> </h5>
                                            </div>
                                            <div class="line-divider"></div>
                                            <div class="post-text">
                                                <p><strong><?php echo $titleTras; ?></strong> <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                                                <p><?php echo $descriptionTras; ?> <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>


                            <div class="col-md-8">
                                <div class="post-content">
                                    <img src=<?php echo $fileName; ?> alt="post-image" class="img-responsive post-image">
                                    <div class="post-container">
                                        <img src=<?php echo $avatar; ?> alt="user" class="profile-photo-md pull-left">
                                        <div class="post-detail">
                                            <div class="user-info">
                                                <h5><a href="timeline.html" class="profile-link"><?php echo $username; ?></a> </h5>
                                            </div>
                                            <div class="line-divider"></div>
                                            <div class="post-text">
                                                <p><strong><?php echo $titleTras; ?></strong> <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                                                <p><?php echo $descriptionTras; ?> <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    </body>

</html>
