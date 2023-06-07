<?php
include "../components/navbar.php";
include "../components/head_template.php";
require "../components/problem_card.php";


session_start();
$_SESSION['searchFor'] = $_SESSION['userType'];
$navbar = returnNavBar(null);

$c1 = getProblemCard("HTG LLC",95,"€ 10.000 / project","Munich Arena", "Munich, Germany","Setup an infrastructure, using AWS.", "DevOps Outsource", "Cloud", "primary", "infinity");
$c2 = getProblemCard("EU",100,"€ 3000 / member","Munich Arena", "Munich, Germany","Training in the latest technologies, practical experience, and career support.", "Law Conference", "Social", "warning", "scale-balanced");
$c3 = getProblemCard("Jeez Trains",80,"€ 30.000 / project","Munich Arena", "Munich, Germany","Develop a web application for HealthTech consulting company.", "ML Internship", "Clean Tech", "success", "brain");
$c4 = getProblemCard("HTG LLC",95,"€ 300.000","Munich Arena", "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Hackathon", "Health Tech", "danger", "star-of-life");

$body = <<<HTML
   
    <h1 class="display-6 text-center p-3"><i class="fa fa-search"></i> Solve Realistic Problems</h1>

   <div class="d-flex flex-wrap justify-content-center">
        $c1
        $c2
        $c3
        $c4
   </div>
   
HTML;


echo page($navbar, $body);

?>