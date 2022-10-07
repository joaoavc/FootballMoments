<?php

require_once( "Lib/lib.php" );
require_once( "Lib/db.php" );
#ini_set('display_errors', 1);
#error_reporting(E_ALL);

$activation_code = $_GET['activation_code'];
$email = $_GET['email'];
$username = $_GET['username'];

dbConnect(ConfigFile);
$dataBaseName1 = $GLOBALS['configDataBase']->db;
mysqli_select_db($GLOBALS['ligacao'], $dataBaseName1);
$query = "SELECT `idUser` FROM `$dataBaseName1`.`auth-challenge`  WHERE `challenge`='" .
        $activation_code . "'";
$queryResult1 = mysqli_query($GLOBALS['ligacao'], $query);
$record = mysqli_fetch_array($queryResult1);
$id = $record["idUser"];

dbConnect(ConfigFile);
$dataBaseName2 = $GLOBALS['configDataBase']->db;
mysqli_select_db($GLOBALS['ligacao'], $dataBaseName2);
$query2 = "UPDATE`$dataBaseName2`.`auth-basic` SET active=1 WHERE  `idUser`=$id";
$queryResult2 = mysqli_query($GLOBALS['ligacao'], $query2);

session_start();
$_SESSION["id"] = $id;
$_SESSION["username"] = $username;

$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);
$serverPort = 80;
$name = webAppName();
$baseUrl = "http://" . $serverName . ":" . $serverPort;
$baseNextUrl = $baseUrl . $name;

$nextUrl = "perfil.php";

header("Location: " . $baseNextUrl . $nextUrl);
?> 