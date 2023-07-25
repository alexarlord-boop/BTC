<?php

require "../utility.php";
session_start();
session_unset();
session_destroy();
$_SESSION = array();

redirect('../pages/main.php');

?>