<?php
include "../components/navbar.php";
include "../components/head_template.php";
require "../components/problem_card.php";


session_start();
$_SESSION['searchFor'] = $_SESSION['userType'];
$navbar = returnNavBar(null);

$c1 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "primary", "star-of-life");
$c2 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "success", "star-of-life");
$c3 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "warning", "star-of-life");
$c4 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "danger", "star-of-life");

$body = <<<HTML
   
    <h1 class="display-6 text-center p-3"><i class="fa fa-search"></i> Find Realistic Problems</h1>

   <div class="d-flex flex-wrap justify-content-center">
        $c1
        $c2
        $c3
        $c4
   </div>
   
HTML;


echo page($navbar, $body);

?>