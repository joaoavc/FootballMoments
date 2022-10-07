<?php

require_once( "Lib/db.php" );
session_start();
$_SESSION = array();
session_destroy();

header("location:index.php?msg=logout");
?>
