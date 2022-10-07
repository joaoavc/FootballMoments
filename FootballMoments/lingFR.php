<?php

require_once( "Lib/lib.php" );
require_once( "Lib/db.php" );
session_start();
$serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING, $flags);
$serverPort = 80;
$name = webAppName();
$baseUrl = "http://" . $serverName . ":" . $serverPort;
$baseNextUrl = $baseUrl . $name;
$nextUrl = "index.php";

//french
$LANGS_FR = array();

//index
$LANGS_FR["seeMyContent"] = "Voir mon contenu";
$LANGS_FR["seeAllContent"] = "Voir tout le contenu";
$LANGS_FR["myProfille"] = "Voir mon profil (Charger le contenu)";
$LANGS_FR["logIn"] = "Ouvrir une session";
$LANGS_FR["logOut"] = "Fermer la session";
$LANGS_FR["register"] = "Enregistrement";
$LANGS_FR["language"] = "Langue";

//language menu
$LANGS_FR["english"] = "Anglais";
$LANGS_FR["french"] = "Français";
$LANGS_FR["portuguese"] = "Portugais";

//log in
$LANGS_FR["sign"] = "Connectez-vous à votre compte";
$LANGS_FR["username"] = "Nom d'utilisateur";
$LANGS_FR["password"] = "Le mot de passe";
$LANGS_FR["missingAccount"] = "Vous n'avez pas de compte?";
$LANGS_FR["registerHere"] = "Inscrivez-vous ici";

//registration
$LANGS_FR["chooseAvatar"] = "Veuillez sélectionner votre avatar préféré:";
$LANGS_FR["submit"] = "Soumettre";
$LANGS_FR["checkMail"] = "Vérifiez votre courrier électronique";
$LANGS_FR["securityCheck"] = "Faisons un rapide contrôle de sécurité";
$LANGS_FR["digitCode"] = "Digit le code";

$LANGS_FR["allContents"] = "Tous les contenus";
$LANGS_FR["profile"] = "Profil";

$LANGS_FR["myContent"] = "Mon contenu";

$LANGS_FR["singleContent"] = "Contenu individuel";

$LANGS_FR["contentNot"] = "Ce contenu n'existe pas...";
$LANGS_FR["contentsNot"] = "Vous n'avez pas de contenu propre...";

$LANGS_FR["private"] = "Privé";
$LANGS_FR["numFiles"] = "Nombre de fichiers:";
$LANGS_FR["userData"] = "Données de l'utilisateur:";

$LANGS_FR["title"] = "Titre:";
$LANGS_FR["description"] = "Description:";

$LANGS_FR["logOrSign"] = " - Connectez-vous ou enregistrez-vous pour accéder à tout le contenu";
$LANGS_FR["contents"] = " - Contenus";

$_SESSION["lang"] = $LANGS_FR;
$lang = "fr";
$_SESSION["language"] = $lang;

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    updateLang($lang, $id);
}

header("Location: " . $baseNextUrl . $nextUrl);
?>
