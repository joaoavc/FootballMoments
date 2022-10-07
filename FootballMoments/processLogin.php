<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
session_destroy();

require_once( "Lib/lib.php" );
require_once( "Lib/db.php" );

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

$username = filter_input($_INPUT_METHOD, 'username', FILTER_SANITIZE_STRING, $flags);
$password = filter_input($_INPUT_METHOD, 'password', FILTER_SANITIZE_STRING, $flags);
$valLogIn = !($username === null || $username == "" || $password === null || $password == "");

$authType = "basic";
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);
$serverPort = 80;
$name = webAppName();
$baseUrl = "http://" . $serverName . ":" . $serverPort;
$baseNextUrl = $baseUrl . $name;
$idUser = isValid($username, $password, $authType, 1);
$nextUrl = "";

$active = getActive($idUser, $authType);
if ($idUser > 0 && $valLogIn) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $idUser;

    $lang = getLang($idUser, $authType);
    userLang($lang);
    $nextUrl = "index.php";
} else {
    
}
header("Location: " . $baseNextUrl . $nextUrl);
?>