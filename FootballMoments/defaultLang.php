<?php

session_start();
if (!isset($_SESSION['lang'])) {
    require_once( "lingEN.php" );
}
?>

