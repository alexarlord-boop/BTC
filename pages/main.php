<?php

include "../components/head_template.php";
include "../components/navbar.php";
include "../components/ui.php";
require "../utility.php";
session_start();
//$_SESSION['userType'] = null;
$_SESSION['title'] = '';
$_SESSION['lnk'] = '';

$navbar = returnNavBar(null);
$title = pageTitle("", "Landing Page");

$goToCompany = getMainBtn("all_teams.php", "Teams");
$goToTeam = getMainBtn("all_companies.php", "Events");
$body = "

            $title
           <div class='card border-0'>
           <div class='card-body '>
           <p class='mt-5'></p>
           <div class='col-12 flex-wrap justify-content-center'>
         
                <h2>Solve realistic problems.</h2>
               <h2>Save time on arranging events.</h2>
               <h2>Search enthusiasts and platforms.</h2>
         
            
            </div>
           </div>
           </div>
           <div class='col-6 offset-3  text-center mt-5'>
                 
                  $goToCompany
                  $goToTeam
                  
            </div>

";


echo page($navbar, $body);

?>