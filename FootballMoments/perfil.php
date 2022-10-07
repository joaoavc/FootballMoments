<?php
require_once( "defaultLang.php" );
#error_reporting(E_ALL);
#ini_set('display_errors', 1);

require_once( "Lib/lib.php" );
session_start();

$upload = "";
if (isset($_SESSION['uploaded'])) {
    if ($_SESSION['uploaded']) {
        $upload = "Uploaded correctly!";
    } else {
        $upload = "Could not upload... Try again.";
    }
}

$authType = "basic";
$username = $_SESSION['username'];
$id = $_SESSION['id'];
$email = getEmail($id, $authType);
$img = getAvatar($id, $authType);
$avatar = getAvatarLinK($img);
$numUploads = getNumUploads($id);
#$numUploads = 0;
unset($_SESSION['uploaded']);
?>
<!doctype html>
<html lang=<?php echo $_SESSION["language"]; ?>>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/perfil.css">
        <title><?php echo $username . " / Football Moments"; ?></title>
    </head>

    <style>

        .frmSearch {
            border: 1px solid #a8d4b1;
            background-color: #c6f7d0;
            margin: 2px 0px;
            padding:40px;
            border-radius:4px;
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
                <img src="assets/images/logo.png"width="30" height="30" class="logo" alt="">
                Football Moments
            </a>


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="mr-auto"></div>

                </ul>

            </div>
        </nav>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="container">
            <div class="card">
                <div class="social-profile">
                    <img class="img-fluid width-100" src=<?php echo $avatar; ?> alt="">
                    <div class="profile-hvr m-t-15">
                        <i class="icofont icofont-ui-edit p-r-10"></i>
                        <i class="icofont icofont-ui-delete"></i>
                    </div>
                </div>
                <div class="card-block social-follower">
                    <h4><?php echo $username; ?></h4>
                    <form enctype="multipart/form-data"
                          action="processUpload.php"
                          name="FormUpload"
                          method="post" >
                        <input name="userFile" type="file" id="upload" hidden/>
                        <input class="input-text"type="text" id="title" name="title" maxlength="30" required placeholder=<?php echo $_SESSION["lang"]["title"]; ?> >
                        <input class="input-text"type="text" id="description" name="description" maxlength="500" required placeholder="<?php echo $_SESSION["lang"]["description"]; ?>"  >
                        <input type="submit" id="submit"hidden>
                        <label class="switch">
                            <input type="checkbox" name="private">
                            <span class="slider round"><?php echo $_SESSION["lang"]["private"]; ?></span>
                        </label>
                        <input type="hidden" name="MAX_FILE_SIZE" required value="<?php echo $configurations['maxFileSize'] ?>">
                        <input name="userFile" type="file" id="upload" accept="image/*|video/*"/>
                        <label id="label2" for="submit"><?php echo $_SESSION["lang"]["submit"]; ?></label>
                    </form>
                    <h4><?php echo $upload; ?></h4>
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text"><?php echo $_SESSION["lang"]["userData"]; ?></h5>
                </div>
                <div class="card-block user-box">
                    <div class="media m-b-10">
                        <div class="media-body">
                            <div class="chat-header">Email</div>
                            <div class="text-muted social-designation"><?php echo $email; ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-block user-box">
                    <div class="media m-b-10">
                        <div class="media-body">
                            <div class="chat-header"><?php echo $_SESSION["lang"]["numFiles"]; ?></div>
                            <div class="text-muted social-designation"><?php echo $numUploads; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    </body>

</html>