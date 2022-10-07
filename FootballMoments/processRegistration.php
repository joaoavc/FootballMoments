<?php

session_start();
require_once( "Lib/lib.php" );
require_once( "Lib/db.php" );
require_once( "Lib/lib-mail-v2.php" );
require_once ("regex.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

$flags[] = FILTER_NULL_ON_FAILURE;
$Account = 1;


$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);
$serverPort = 80;
$name = webAppName();
$baseUrl = "http://" . $serverName . ":" . $serverPort;
$baseNextUrl = $baseUrl . $name;

if (isset($_SESSION['usernameR'])) {
    $serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);
    $username = $_SESSION['usernameR'];
    $email = $_SESSION['emailR'];
    $password = $_SESSION['passwordR'];
    $avatar = $_SESSION['avatarR'];
    $active = 0;
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $emailVal = filter_var($email, FILTER_VALIDATE_EMAIL) &&
            preg_match($regexEmail, $email);
    
    $usernameVal = preg_match($regexUsername, $username);
    $passwordVal = preg_match($regexPassword, $password);
    
    $avatarVal = $avatar != "";
    $formVal = $emailVal && $usernameVal && $passwordVal && $avatarVal;
    $serverPort = 80;
    
    $idUser = isValid($username, $password, "basic", 1);
    if ($idUser == "" && $formVal) {
        insertBasic($username, $password, $email, $active, $avatar);
        $challenge = generateActivationCode();
        insertChallenge($username, $password, $active, $challenge);
        $id = isValid($username, $password, "basic", 1);

        session_start();
        $_SESSION["email"] = $email;

        // create the activation link
        $activation_link = $baseNextUrl . "/activate.php?email=$email&activation_code=$challenge&username=$username";
        $ToEmail = $email;

        dbConnect(ConfigFile);

        $dataBaseName = $GLOBALS['configDataBase']->db;

        mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

        $queryString = "SELECT * FROM `$dataBaseName`.`email-accounts` WHERE `id`='$Account'";
        $queryResult = mysqli_query($GLOBALS['ligacao'], $queryString);
        $record = mysqli_fetch_array($queryResult);

        $smtpServer = $record['smtpServer'];
        $port = intval($record['port']);
        $useSSL = boolval($record['useSSL']);
        $timeout = intval($record['timeout']);
        $loginName = $record['loginName'];
        $password = $record['password'];
        $fromEmail = $record['email'];
        $fromName = $record['displayName'];

        mysqli_free_result($queryResult);

        dbDisconnect();

        $Message = "Hi,
            Please click the following link to activate your account:
            $activation_link";

        $Subject = "Football Moments, email validation";

        $result = sendAuthEmail(
                $smtpServer,
                $useSSL,
                $port,
                $timeout,
                $loginName,
                $password,
                $fromEmail,
                $fromName,
                $ToName . " <" . $ToEmail . ">",
                NULL,
                NULL,
                $Subject,
                $Message,
                false, // set to true see debug messages
                NULL);

        if ($result == true) {
            $userMessage = "was";
            //echo "was" ;
        } else {
            $userMessage = "could not be";
            //echo "could not be" ;
        }

        $serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);

        $serverPort = 80;

        $name = webAppName();

        $baseUrl = "http://" . $serverName . ":" . $serverPort;

        $baseNextUrl = $baseUrl . $name;

        $nextUrl = "sendToCheckEmail.php";
        echo $baseNextUrl . $nextUrl;
        header("Location: " . $baseNextUrl . $nextUrl);
    }
}
?>