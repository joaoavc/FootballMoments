<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <title>Image Processing</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="stylesheet" typr="text/css" href="../Styles/GlobalStyle.css">
    </head>

    <body>
        <?php
        require_once( "Lib/lib.php" );
        require_once( "Lib/db.php" );

        session_start();

        $serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);

        $serverPort = 80;

        $name = webAppName();
        $baseUrl = "http://" . $serverName . ":" . $serverPort;
        $baseNextUrl = $baseUrl . $name;
        $nextUrl = "processRegistration.php";
        $back = "captcha.php";
        header("Location: " . $baseNextUrl . $nextUrl);

        if ($_SESSION['captcha'] == $_POST['captcha']) {
            header("Location: " . $baseNextUrl . $nextUrl);
        } else {
            header("Location: " . $baseNextUrl . $back);
        }
        ?>

    </body>
</html>