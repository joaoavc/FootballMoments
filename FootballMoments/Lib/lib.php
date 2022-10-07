<?php

require_once( "db.php" );

function userLang($lang) {
    if ($lang == "en") {
        require_once( "lingEN.php" );
    } else if ($lang == "pt") {
        require_once( "lingPT.php" );
    } else if ($lang == "fr") {
        require_once( "lingFR.php" );
    }
}

function getFilesTitlesId($idUser) {
    $titlesIdsMap = array();
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    $user = $idUser;
    $whereClause = "WHERE `idUser`= $user";
    $query = "SELECT `fileName`, `id`, `title`, `private` FROM `$dataBaseName`.`images-details`" . $whereClause;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if (!empty($result)) {
        foreach ($result as $content) {
            $titleId = $content["title"] . "(" . $content["id"] . ")";

            $titlesIdsMap[$titleId] = $content["id"];
        }
    }
    return $titlesIdsMap;
}

function getAvatarsMap() {
    $avaMap = array();
    $avaMap['img1'] = 'https://bootdey.com/img/Content/avatar/avatar1.png';
    $avaMap['img2'] = 'https://bootdey.com/img/Content/avatar/avatar2.png';
    $avaMap['img3'] = 'https://bootdey.com/img/Content/avatar/avatar3.png';
    $avaMap['img4'] = 'https://bootdey.com/img/Content/avatar/avatar4.png';
    $avaMap['img5'] = 'https://bootdey.com/img/Content/avatar/avatar5.png';
    $avaMap['img6'] = 'https://bootdey.com/img/Content/avatar/avatar6.png';
    $avaMap['img7'] = 'https://bootdey.com/img/Content/avatar/avatar7.png';
    $avaMap['img8'] = 'https://bootdey.com/img/Content/avatar/avatar8.png';
    return $avaMap;
}

function getAvatarLinK($img) {
    $avaMap = getAvatarsMap();
    return $avaMap[$img];
}

function getBrowser() {
    $userBrowser = '';
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    if (preg_match('/Trident/i', $userAgent)) {
        $userBrowser = "Internet Explorer";
    } elseif (preg_match('/MSIE/i', $userAgent)) {
        $userBrowser = "Internet Explorer";
    } elseif (preg_match('/Firefox/i', $userAgent)) {
        $userBrowser = "Mozilla Firefox";
    } elseif (preg_match('/Safari/i', $userAgent)) {
        $userBrowser = "Apple Safari";
    } elseif (preg_match('/Chrome/i', $userAgent)) {
        $userBrowser = "Google Chrome";
    } elseif (preg_match('/Flock/i', $userAgent)) {
        $userBrowser = "Flock";
    } elseif (preg_match('/Opera/i', $userAgent)) {
        $userBrowser = "Opera";
    } elseif (preg_match('/Netscape/i', $userAgent)) {
        $userBrowser = "Netscape";
    }

    if (preg_match('/Mobile/i', $userAgent)) {
        $userBrowser = "Mobile Device";
    }
    return $userBrowser;
}

function redirectToPage($url, $title, $message, $refreshTime = 5) {
    echo "<html>\n";
    echo "  <head>\n";
    echo "    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>\n";
    echo "    <meta http-equiv=\"REFRESH\" content=\"$refreshTime;url=$url\">\n";
    echo "    <title>$title</title>\n";
    echo "  </head>\n";
    echo "  <body>\n";
    echo "    <p>$message</p>";
    echo "    <p>You will be redirect in $refreshTime seconds.</p>";
    echo "  </body>\n";
    echo "</html>";
    die();
}

$DefaultRedirectMessage = <<<EOD
    <p>Invalid data!</p>
    <p>Please fill all the requiered fields (marked with *).</p>
EOD;

function redirectToLastPage($title, $message = NULL, $refreshTime = 5) {
    $referer = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);

    echo "<html>\n";
    echo "  <head>\n";
    echo "    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>\n";
    echo "    <meta http-equiv=\"REFRESH\" content=\"$refreshTime;url=$referer\">\n";
    echo "    <title>$title</title>\n";
    echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    echo "    <link REL=\"stylesheet\" TYPE=\"text/css\" href=\"../Styles/GlobalStyle.css\">\n";
    echo "  </head>\n";
    echo "  <body>\n";
    if ($message != NULL) {
        echo $message;
    } else {
        echo $GLOBALS['DefaultRedirectMessage'];
    }
    echo "    <p>You will be redirect to the last page in $refreshTime seconds.\n";
    echo "  </body>\n";
    echo "</html>";
    die();
}

$find;
$replace;

function convertToEntities($str) {
    global $find;
    global $replace;

    if (($find == NULL) || ($replace == NULL)) {
        $find = array();
        $replace = array();

        foreach (get_html_translation_table(HTML_ENTITIES, ENT_QUOTES) as $key => $value) {
            $find[] = $key;
            $replace[] = $value;
        }
    }

    return str_replace($find, $replace, $str);
}

function webAppName() {
    $uri = explode("/", $_SERVER['REQUEST_URI']);
    $n = count($uri);
    $webApp = "";
    for ($idx = 0; $idx < $n - 1; $idx++) {
        $webApp .= ($uri[$idx] . "/" );
    }

    return $webApp;
}

function prepareHeaders() {
    list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}

function ensureAuth($redirectPage) {
    prepareHeaders();

    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
        header("Location: $redirectPage");
        exit;
    }
}

function showAuth($authType, $realm, $message) {
    header("WWW-Authenticate: $authType realm=\"$realm\"");
    header("HTTP/1.0 401 Unauthorized");

    echo $message;
}

function isValid($userName, $password, $authType, $activity) {
    $userOk = -1;

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    echo $dataBaseName;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT * FROM `$dataBaseName`.`auth-$authType` " .
            "WHERE `name`='$userName' AND `password`='$password' AND `active`='$activity'";
    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if ($result != false) {
        $userData = mysqli_fetch_array($result);
        $userOk = $userData['idUser'];
    }
    mysqli_free_result($result);

    dbDisconnect();
    return $userOk;
}

function existUserField($field, $value, $authType = "basic") {
    $exists = true;

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT * FROM `$dataBaseName`.`auth-$authType` " .
            "WHERE `$field`='$value'";
    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if ($result == false || mysqli_num_rows($result) == 0) {
        $exists = false;
    }

    mysqli_free_result($result);

    dbDisconnect();

    return $exists;
}

function getRole($userId) {
    $userRoles = "";

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT `friendlyName` " .
            "FROM `$dataBaseName`.`auth-basic` u " .
            "JOIN `$dataBaseName`.`auth-permissions` p ON u.`idUser`=p.`idUser` " .
            "JOIN `$dataBaseName`.`auth-roles` r on p.`idRole`=r.`idRole` WHERE u.`active`=1 AND u.`idUser`='$userId'";

    $result = mysqli_query($GLOBALS['ligacao'], $query);

    $isFirst = true;
    $userRoles .= "[";

    while ($userData = mysqli_fetch_array($result)) {
        if ($isFirst == true) {
            $isFirst = false;
        } else {
            $userRoles .= ", ";
        }

        $userRoles .= $userData['friendlyName'];
    }
    $userRoles .= "]";

    mysqli_free_result($result);

    dbDisconnect();

    return $userRoles;
}

function getEmail($idUser, $authType) {
    $userEmail = "";

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT `email` FROM `$dataBaseName`.`auth-$authType` WHERE `idUser`='$idUser'";

    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if ($result != false) {
        $userData = mysqli_fetch_array($result);
        $userEmail = $userData['email'];
    }
    mysqli_free_result($result);

    dbDisconnect();

    return $userEmail;
}

function getAvatar($idUser, $authType) {
    $userAvatar = "";

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT `avatar` FROM `$dataBaseName`.`auth-$authType` WHERE `idUser`='$idUser'";

    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if ($result != false) {
        $userData = mysqli_fetch_array($result);
        $userAvatar = $userData['avatar'];
    }
    mysqli_free_result($result);

    dbDisconnect();

    return $userAvatar;
}

function getUsername($idUser, $authType) {
    $username = "";

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT `name` FROM `$dataBaseName`.`auth-$authType` WHERE `idUser`='$idUser'";

    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if ($result != false) {
        $userData = mysqli_fetch_array($result);
        $username = $userData['name'];
    }
    mysqli_free_result($result);

    dbDisconnect();

    return $username;
}

function getActive($idUser, $authType) {
    $active = "";

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT `active` FROM `$dataBaseName`.`auth-$authType` WHERE `idUser`='$idUser'";

    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if ($result != false) {
        $userData = mysqli_fetch_array($result);
        $active = $userData['active'];
    }
    mysqli_free_result($result);

    dbDisconnect();

    return $active;
}

function getLang($idUser, $authType) {
    $lang = "";

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT `lang` FROM `$dataBaseName`.`auth-$authType` WHERE `idUser`='$idUser'";

    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if ($result != false) {
        $userData = mysqli_fetch_array($result);
        $lang = $userData['lang'];
    }
    mysqli_free_result($result);

    dbDisconnect();

    return $lang;
}

function getNumUploads($idUser) {
    $userUploads = 0;
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "SELECT `idUser` FROM `$dataBaseName`.`images-details` WHERE `idUser`='$idUser'";
    $result = mysqli_query($GLOBALS['ligacao'], $query);
    if ($result != false) {
        while ($registo = mysqli_fetch_array($result)) {
            $userUploads++;
        }
    }
    return $userUploads;
}

function logout($authType, $realm, $location) {
    unset($_SERVER['PHP_AUTH_USER']);
    unset($_SERVER['PHP_AUTH_PW']);
    unset($_SERVER['HTTP_AUTHORIZATION']);

    header("WWW-Authenticate: $authType realm=\"$realm\"");
    header("HTTP/1.0 401 Unauthorized");

    header("Location: $location");
}

function logout2($authType, $realm, $location) {
    unset($_SERVER['PHP_AUTH_USER']);
    unset($_SERVER['PHP_AUTH_PW']);
    unset($_SERVER['HTTP_AUTHORIZATION']);

    header("WWW-Authenticate: $authType realm=\"$realm\"");
    header("HTTP/1.0 401 Unauthorized");

    header("Location: $location");
}

function getFileDetails($ids) {
    $isFirst = true;
    $whereClause = "";

    if (is_array($ids)) {
        foreach ($ids as $id) {
            if ($isFirst == false) {
                $whereClause .= " OR `id`='$id'";
            } else {
                $whereClause .= "`id`='$id'";
                $isFirst = false;
            }
        }
    } else {
        $whereClause = "`id`='$ids'";
    }

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT * FROM `$dataBaseName`.`images-details` WHERE " . $whereClause;

    $result = mysqli_query($GLOBALS['ligacao'], $query);

    $fileData = array();
    while (($fileDataRecord = mysqli_fetch_array($result)) != false) {
        $fileData[] = $fileDataRecord;
    }

    mysqli_free_result($result);
    dbDisconnect();

    if (!is_array($ids)) {
        return $fileData[0];
    } else {
        return $fileData;
    }
}

function getConfiguration() {
    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $query = "SELECT * FROM `$dataBaseName`.`images-config`";

    $result = mysqli_query($GLOBALS['ligacao'], $query);

    $configuration = mysqli_fetch_array($result);

    mysqli_free_result($result);

    dbDisconnect();

    return $configuration;
}

function getStats() {
    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    "SELECT COUNT(DISTINCT `mimeFileName`) FROM `$dataBaseName`.`images-details`;";
    "SELECT DISTINCT `mimeFileName` FROM `$dataBaseName`.`images-details`;";

    $queryTotal = "SELECT count(*) AS totalFiles FROM `$dataBaseName`.`images-details`";
    $queryImages = "SELECT count(*) AS totalImages FROM `$dataBaseName`.`images-details` WHERE `mimeFileName`='image'";
    $queryVideos = "SELECT count(*) AS totalVideos FROM `$dataBaseName`.`images-details` WHERE `mimeFileName`='video'";
    $queryAudios = "SELECT count(*) AS totalAudios FROM `$dataBaseName`.`images-details` WHERE `mimeFileName`='audio'";

    // Total files
    $resultTotal = mysqli_query($GLOBALS['ligacao'], $queryTotal);
    $totalData = mysqli_fetch_array($resultTotal);
    $stats['numFiles'] = $totalData['totalFiles'];
    mysqli_free_result($resultTotal);

    if ($stats['numFiles'] == 0) {
        $stats['numImages'] = 0;
        $stats['numVideos'] = 0;
        $stats['numAudios'] = 0;

        dbDisconnect();

        return $stats;
    }

    // Image files
    $resultImages = mysqli_query($GLOBALS['ligacao'], $queryImages);
    $totalImages = mysqli_fetch_array($resultImages);
    $stats['numImages'] = $totalImages['totalImages'];
    mysqli_free_result($resultImages);

    // Video files
    $resultVideos = mysqli_query($GLOBALS['ligacao'], $queryVideos);
    $totalVideos = mysqli_fetch_array($resultVideos);
    $stats['numVideos'] = $totalVideos['totalVideos'];
    mysqli_free_result($resultVideos);

    // Audio files
    $resultAudios = mysqli_query($GLOBALS['ligacao'], $queryAudios);
    $totaltAudios = mysqli_fetch_array($resultAudios);
    $stats['numAudios'] = $totaltAudios['totalAudios'];
    mysqli_free_result($resultAudios);

    dbDisconnect();

    return $stats;
}

function showUploadFileError($errorCode) {
    switch ($errorCode) {
        case UPLOAD_ERR_OK:
            $errorMessage = "($errorCode) There is no error, the file uploaded with success.";
            break;

        case UPLOAD_ERR_INI_SIZE:
            $errorMessage = "($errorCode) The uploaded file exceeds the upload_max_filesize directive in php.ini file.";
            break;

        case UPLOAD_ERR_FORM_SIZE:
            $errorMessage = "($errorCode) The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
            break;

        case UPLOAD_ERR_PARTIAL:
            $errorMessage = "($errorCode) The uploaded file was only partially uploaded.";
            break;

        case UPLOAD_ERR_NO_FILE:
            $errorMessage = "($errorCode) No file was uploaded.";
            break;

        case UPLOAD_ERR_NO_TMP_DIR:
            $errorMessage = "($errorCode) Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.";
            break;

        case UPLOAD_ERR_CANT_WRITE:
            $errorMessage = "($errorCode) Failed to write file to disk. Introduced in PHP 5.1.0.";
            break;

        case UPLOAD_ERR_EXTENSION:
            $errorMessage = "($errorCode) A PHP extension stopped the file upload.";
            break;

        default:
            $errorMessage = "($errorCode) No description available.";
            break;
    }

    return $errorMessage;
}

function getXdebugArg() {
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {
        $args = $_POST;
    } elseif ($method == 'GET') {
        $args = $_GET;
    }

    foreach ($args as $key => $value) {
        if ($key === "XDEBUG_SESSION_START") {
            return "XDEBUG_SESSION_START=$value";
        }
    }

    return null;
}

function getXdebugArgAsArray() {
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method == 'POST') {
        $args = $_POST;
    } elseif ($method == 'GET') {
        $args = $_GET;
    }

    foreach ($args as $key => $value) {
        if ($key === "XDEBUG_SESSION_START") {
            return array("key" => $key, "value" => $value);
        }
    }

    return null;
}

function generateActivationCode(): string {
    return bin2hex(random_bytes(16));
}

function insertBasic($username, $password, $email, $active, $avatar) {
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $lang = "en";
    $query = "INSERT INTO `$dataBaseName`.`auth-basic` (`name`, `password`, `email`, `active`, `avatar`, `lang`) "
            . "VALUES ('" . $username . "', '" . $password . "', '" . $email . "', '" . $active . "', '" . $avatar . "', '" . $lang . "')";
    echo "Query to exec: " . $query . "\n<br>";
    $queryResult = mysqli_query($GLOBALS['ligacao'], $query);
    echo "Query result: " . $queryResult . "\n<br>";
}

function insertChallenge($username, $password, $active, $challenge) {


    $idUser = isValid($username, $password, "basic", $active);

    dbConnect(ConfigFile);

    $dataBaseName = $GLOBALS['configDataBase']->db;

    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);

    $date = date("Ymd");
    $query = "INSERT INTO `$dataBaseName`.`auth-challenge` (`idUser`, `challenge`, `registerDate`) "
            . "VALUES ('" . $idUser . "', '" . $challenge . "', '" . $date . "')";
    echo "Query to exec: " . $query . "\n<br>";
    $queryResult2 = mysqli_query($GLOBALS['ligacao'], $query);
    echo "Query result: " . $queryResult2 . "\n<br>";
}

function updateLang($lang, $idUser) {
    dbConnect(ConfigFile);
    $dataBaseName = $GLOBALS['configDataBase']->db;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $query = "UPDATE `$dataBaseName`.`auth-basic` SET `lang` = '$lang' WHERE `idUser` = " . $idUser;
    echo $query;
    $queryResult = mysqli_query($GLOBALS['ligacao'], $query);
}

/*
  function send_activation_email(string $email, string $activation_code): void
  {
  // create the activation link
  $activation_link = APP_URL . "/activate.php?email=$email&activation_code=$activation_code";

  // set email subject & body
  $subject = 'Please activate your account';
  $message = <<<MESSAGE
  Hi,
  Please click the following link to activate your account:
  $activation_link
  MESSAGE;
  // email header
  $header = "From:" . SENDER_EMAIL_ADDRESS;

  // send the email
  mail($email, $subject, nl2br($message), $header);

  }
 */
?>