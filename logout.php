<?php
session_start();
require_once 'config_db.php';
require_once 'utils/helper.php';
userlogs('Logout',$conn);
session_destroy();
header( "location: index.php" );
?>