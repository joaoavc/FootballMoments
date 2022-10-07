<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("Lib/lib.php");
session_start();
dbConnect(ConfigFile);
$dataBaseName = $GLOBALS['configDataBase']->db;

if (!empty($_POST["keyword"])) {

    $user = $_SESSION['id'];
    $whereClause = "WHERE `idUser`= '$user' AND title like '" . $_POST["keyword"] . "%' ORDER BY title LIMIT 0,6";
    $query = "SELECT `fileName`, `id`, `title`, `private` FROM `$dataBaseName`.`images-details`" . $whereClause;
    mysqli_select_db($GLOBALS['ligacao'], $dataBaseName);
    $result = mysqli_query($GLOBALS['ligacao'], $query);

    if (!empty($result)) {
        ?>
        <ul id="content-list">
            <?php
            foreach ($result as $content) {
                $titleId = $content["title"] . "(" . $content["id"] . ")";
                ?>
                <li onClick="selectContent('<?php echo $titleId; ?>');"><?php echo $titleId; ?></li>
            <?php }
            ?>
        </ul>
    <?php }
}
?>
