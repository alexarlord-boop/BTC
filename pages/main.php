<?php
session_start();
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/ui.php";
require "../utility.php";

$label = getLabel();

$title = pageTitle("", "Intro");

$goToCompany = getMainBtn("all_teams.php", "Teams");
$goToTeam = getMainBtn("all_events.php", "Events");
$body = "
            <div style='position: absolute; top:-10px; right: 100px;'>$label</div>
            
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



$navbar = returnNavBar(null);
echo page($navbar, $body);



?>