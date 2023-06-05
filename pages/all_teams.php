<?php
include "../components/navbar.php";
include "../components/head_template.php";
require "../utility.php";
session_start();
$_SESSION['searchFor'] = $_SESSION['userType'];
$navbar = returnNavBar(null);
$body = <<<HTML
   
    <div class="display-4"><i class="fa  fa-search"></i> Search for the Best Team</div>
    
   
HTML;


echo page($navbar, $body);

?>