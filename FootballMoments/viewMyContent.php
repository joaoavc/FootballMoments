<?php
require_once( "Lib/lib.php" );
require_once( "Lib/db.php" );
require_once( "defaultLang.php" );
require_once ("translateGoogle.php");

#error_reporting(E_ALL);
#ini_set('display_errors', 1);

dbConnect(ConfigFile);
$dataBaseName = $GLOBALS['configDataBase']->db;
mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
$myId = $_SESSION['id'];
$whereClause = "WHERE `idUser`='$myId'";
if (isset($_SESSION['username'])) {
    $query = "SELECT `fileName`, `title`, `description`, `idUser`, `mimeFileName` FROM "
            . "`$dataBaseName`.`images-details`" . $whereClause;
    $authenticated = "";
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
        <title>Football Moments / <?php echo $_SESSION["lang"]["myContent"]; ?></title>
    </head>

    <style>

        .frmSearch {
            border: 1px solid #a8d4b1;
            background-color: #c6f7d0;
            margin: 0px 0px;
            padding:10px;
            border-radius:10px;
        }
        #content-list{
            float:left;
            list-style:none;
            margin-top:-3px;
            padding:0;
            width:190px;
            position: absolute;
        }
        #content-list li{
            padding: 10px;
            background: #f0f0f0;
            border-bottom: #bbb9b9 1px solid;
        }
        #content-list li:hover{
            background:#ece3d2;
            cursor: pointer;
        }
        #search-box{
            padding: 10px;
            border: #a8d4b1 1px solid;
            border-radius:4px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script>
        // AJAX call for autocomplete 
        $(document).ready(function () {
            $("#search-box").keyup(function () {
                $.ajax({
                    type: "POST",
                    url: "readFileTitle.php",
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function () {
                        $("#search-box").css("background", "#FFF url(assets/images/LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function (data) {
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);
                        $("#search-box").css("background", "#FFF");
                    }
                });
            });
        });

        //To select country name
        function selectContent(val) {
            $("#search-box").val(val);
            $("#suggesstion-box").hide();
        }
    </script>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" style="color:white" href="index.php">
                <img src="assets/images/logo.png"width="30" height="30" class="logo" alt="" >
                Football Moments
            </a>

            <form action="processSelectedFile.php"
                  name="formSearch"
                  method="post" >
                <div class="frmSearch">
                    <input name="contentTitleId" type="text" id="search-box" placeholder="Resource Title" required/>
                    <input type="submit" value="Show" />
                    <div id="suggesstion-box"></div>
                </div>
            </form>

            <div class="mr-auto"></div>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item active">
                    <a class="nav-link"style="color:white"  href="checkAuthProfile.php"><?php echo $_SESSION["lang"]["profile"]; ?> <span class="sr-only">(current)</span></a>
                </li>
                </div>
        </nav>
        <div class="Search">
            <h4><?php echo $_SESSION['username'] . $_SESSION["lang"]["contents"] ?></h4>
        </div>
        <div class="container">
            <div class="row">
                <?php
                $isQuerry = false;
                if ($queryResult) {
                    $result[] = array('fileName' => "", 'title' => "", 'description' => "", 'idUser' => "");
                    while ($registo = mysqli_fetch_array($queryResult)) {
                        $isQuerry = true;
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
                <?php if (!$isQuerry) { ?>
                    <h4> <?php echo $_SESSION["lang"]["contentsNot"]; ?></h4>
                <?php } ?>   
            </div>
        </div>

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    </body>

</html>
