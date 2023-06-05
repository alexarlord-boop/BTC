<?php
include "../components/navbar.php";
include "../components/head_template.php";
require "../utility.php";
session_start();
$_SESSION['searchFor'] = $_SESSION['userType'];
$navbar = returnNavBar(null);
$body = <<<HTML
   
    <h1 class="display-4"><i class="fa  fa-search"></i> Find the Best Company</h1>
    
   
HTML;


echo page($navbar, $body);

?>