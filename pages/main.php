<?php
session_start();
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/ui.php";
require_once "../utility.php";

//$_SESSION['userType'] = null;
$_SESSION['title'] = '';
$_SESSION['lnk'] = '';

$navbar = returnNavBar(null);
$title = pageTitle("", "Landing Page");

$goToCompany = getMainBtn("all_teams.php", "Teams");
$goToTeam = getMainBtn("all_events.php", "Events");
$body = "
                <img src='../animations/anim1.png' height='1000' width='1000' style='position: absolute; top:-300px; right: 0px; z-index: -1;'/>
            $title
           <div class='card  bg-transparent border-0'>
           <div class='card-body'>
           <p class='mt-5'></p>
           <div class='col-md-6 offset-md-1 flex-wrap justify-content-center'>
         
                <h2>Solve realistic problems.</h2>
               <h2>Save time on arranging events.</h2>
               <h2>Search enthusiasts and platforms.</h2>
         
            
            </div>
           </div>
           </div>
           <div class='col-6 offset-3 my-5  text-center mt-5'>
                 
                  $goToCompany
                  $goToTeam
                  
            </div>
";


echo page($navbar, $body);

?>