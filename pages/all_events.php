<?php
include "../components/navbar.php";
include "../components/head_template.php";
require "../utility.php";
session_start();
$_SESSION['searchFor'] = $_SESSION['userType'];
$navbar = returnNavBar(null);
$body = <<<HTML
   
    <div class="display-6 text-center p-3"><i class="fa  fa-search"></i> Search for Events</div>
    
   
HTML;


echo page($navbar, $body);

?>