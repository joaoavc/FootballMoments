<!doctype html>
<?php
require_once( "defaultLang.php" );
require_once( "Lib/lib.php" );
require_once( "Lib/db.php" );
session_start();
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && $_POST['avatar']) {
    $flags[] = FILTER_NULL_ON_FAILURE;
    $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING, $flags);

    if ($method == 'POST') {
        $_INPUT_METHOD = INPUT_POST;
    } elseif ($method == 'GET') {
        $_INPUT_METHOD = INPUT_GET;
    } else {
        echo "Invalid HTTP method (" . $method . ")";
        exit();
    }
    $flags[] = FILTER_NULL_ON_FAILURE;

    $_SESSION['usernameR'] = filter_input($_INPUT_METHOD, 'username', FILTER_SANITIZE_STRING, $flags);
    $_SESSION['passwordR'] = filter_input($_INPUT_METHOD, 'password', FILTER_SANITIZE_STRING, $flags);
    $_SESSION['emailR'] = filter_input($_INPUT_METHOD, 'email', FILTER_SANITIZE_STRING, $flags);
    $_SESSION['avatarR'] = filter_input($_INPUT_METHOD, 'avatar', FILTER_SANITIZE_STRING, $flags);
}
?>
<html lang=<?php echo $_SESSION["language"]; ?>>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/captcha.css">
        <title>Football Moments / Captcha</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" style="color:white" href="#">
                <img src="assets/images/logo.png"width="30" height="30" class="logo" alt="">
                Football Moments
            </a>

<?php
include_once( "configDebug.php" );

if ($debug == true) {
    $value = "value=\"" . $captchaValue . "\"";
    echo "<p>Debug is active</p>";
} else {
    $value = "value=\"\"";
}
?>

        </nav>
        <div class="content">
            <h4><?php echo $_SESSION["lang"]["securityCheck"]; ?></h4>
            <p></p>
            <form method="post" action="captchaProcess.php">
                <img src="captchaImage.php"/><br>

                <label for="captcha"><?php echo $_SESSION["lang"]["digitCode"]; ?></label><br>

                <input type="text" name="captcha" id="captcha" <?php echo $value; ?>><br>
                <p></p>
                <input class="btn btn--radius-2 btn--red"type="submit" value=<?php echo $_SESSION["lang"]["submit"]; ?>> 
            </form>
        </div>



        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    </body>

</html>