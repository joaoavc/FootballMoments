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

//portuguese
$LANGS_PT = array();

//index
$LANGS_PT["seeMyContent"] = "Ver o meu conteúdo";
$LANGS_PT["seeAllContent"] = "Ver todo o conteúdo";
$LANGS_PT["myProfille"] = "Ver o meu perfíl (Carregar ficheiro)";
$LANGS_PT["logIn"] = "Início de Sessão";
$LANGS_PT["logOut"] = "Sair";
$LANGS_PT["register"] = "Regista-te";
$LANGS_PT["language"] = "Idioma";

//language menu
$LANGS_PT["english"] = "Inglês";
$LANGS_PT["french"] = "Francês";
$LANGS_PT["portuguese"] = "Português";

//log in
$LANGS_PT["sign"] = "Entre na sua conta";
$LANGS_PT["username"] = "Nome de utilizador";
$LANGS_PT["password"] = "Palavra passe";
$LANGS_PT["missingAccount"] = "Ainda não tem conta?";
$LANGS_PT["registerHere"] = "Inscreva-se aqui";

//registration
$LANGS_PT["chooseAvatar"] = "Escolha o seu avatar:";
$LANGS_PT["submit"] = "Submeter";
$LANGS_PT["checkMail"] = "Verifique o seu email";
$LANGS_PT["securityCheck"] = "Vamos fazer uma rápida verificação de segurança";
$LANGS_PT["digitCode"] = "Digite o código";

$LANGS_PT["allContents"] = "Todos os conteúdos";
$LANGS_PT["profile"] = "Perfíl";

$LANGS_PT["myContent"] = "Meu conteúdo";

$LANGS_PT["singleContent"] = "Conteúdo singular";

$LANGS_PT["contentNot"] = "Este conteúdo não existe...";
$LANGS_PT["contentsNot"] = "Não tem conteúdos próprios...";

$LANGS_PT["private"] = "Privado";
$LANGS_PT["numFiles"] = "Número de ficheiros:";
$LANGS_PT["userData"] = "Dados do utilizador:";

$LANGS_PT["title"] = "Título:";
$LANGS_PT["description"] = "Descrição:";
$LANGS_PT["contents"] = " - Conteúdos";

$LANGS_PT["logOrSign"] = " - Inicie a sessão ou registe-se para ter acesso a todos os conteúdos";

$_SESSION["lang"] = $LANGS_PT;
$lang = "pt";
$_SESSION["language"] = $lang;

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    updateLang($lang, $id);
}

header("Location: " . $baseNextUrl . $nextUrl);
?>


