<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once( "Lib/lib.php" );
require_once( "Lib/db.php" );
session_start();
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);
$serverPort = 80;
$name = webAppName();
$baseUrl = "http://" . $serverName . ":" . $serverPort;
$baseNextUrl = $baseUrl . $name;
$nextUrl = "index.php";

//english
$LANGS_EN = array();

//index
$LANGS_EN["seeMyContent"] = "See my content";
$LANGS_EN["seeAllContent"] = "See all content";
$LANGS_EN["myProfille"] = "Ver o meu perfíl (Carregar ficheiro)";
$LANGS_EN["logIn"] = "Log In";
$LANGS_EN["logOut"] = "Log Out";
$LANGS_EN["register"] = "Register";
$LANGS_EN["language"] = "Language";

// language menu
$LANGS_EN["english"] = "English";
$LANGS_EN["french"] = "French";
$LANGS_EN["portuguese"] = "Portuguese";

//log in
$LANGS_EN["sign"] = "Sign into your account";
$LANGS_EN["username"] = "Username";
$LANGS_EN["password"] = "Password";
$LANGS_EN["missingAccount"] = "Don't have an account?";
$LANGS_EN["registerHere"] = "Register here";

//registration
$LANGS_EN["chooseAvatar"] = "Please select your favorite Avatar:";
$LANGS_EN["submit"] = "Submit";
$LANGS_EN["checkMail"] = "Check Your Email";
$LANGS_EN["securityCheck"] = "Let's do a quick security check";
$LANGS_EN["digitCode"] = "Digit the Code";

$LANGS_EN["allContents"] = "All contents";
$LANGS_EN["profile"] = "Profile";

$LANGS_EN["myContent"] = "My content";

$LANGS_EN["singleContent"] = "Single Content";

$LANGS_EN["contentNot"] = "This content doesn´t not exist...";
$LANGS_EN["contentsNot"] = "You have no contents of your own...";

$LANGS_EN["private"] = "Private";
$LANGS_EN["numFiles"] = "Number of files:";
$LANGS_EN["userData"] = "User Data:";
$LANGS_EN["title"] = "Title:";
$LANGS_EN["description"] = "Description:";

$LANGS_EN["logOrSign"] = " - Log in or register to access all content";
$LANGS_EN["contents"] = " - Contents";

$_SESSION["lang"] = $LANGS_EN;
$lang = "en";
$_SESSION["language"] = $lang;

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    updateLang($lang, $id);
}

header("Location: " . $baseNextUrl . $nextUrl);
?>
