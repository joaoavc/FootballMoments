<?php

require_once( "Lib/lib.php" );
require_once( "Lib/db.php" );
session_start();
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);
$serverPort = 80;
$name = webAppName();
$baseUrl = "http://" . $serverName . ":" . $serverPort;
$baseNextUrl = $baseUrl . $name;

if (isset($_SESSION['username'])) {
    $nextUrl = "perfil.php";
} else {
    $nextUrl = "logIn.php";
}
header("Location: " . $baseNextUrl . $nextUrl);
?>