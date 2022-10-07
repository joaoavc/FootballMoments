<?php

session_start();
require_once( "Lib/lib.php" );
require_once( "Lib/db.php" );

if (!empty($_POST["contentTitleId"])) {
    $myId = $_SESSION['id'];
    $idTitleContentsMap = getFilesTitlesId($myId);
    $id = $idTitleContentsMap[$_POST["contentTitleId"]];
    $_SESSION["contentId"] = $id;
    $_SESSION["contentTitleId"] = $_POST["contentTitleId"];

    $serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);
    $serverPort = 80;
    $name = webAppName();
    $baseUrl = "http://" . $serverName . ":" . $serverPort;
    $baseNextUrl = $baseUrl . $name;
    $nextUrl = "viewMySingleContent.php";
    header("Location: " . $baseNextUrl . $nextUrl);
}
?>
