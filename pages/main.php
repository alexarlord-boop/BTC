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
$title = pageTitle("", "           <h2>We are = <span class='text-primary'>Business</span> + <span class='text-success'>Teams</span>.</h2>
");

$goToCompany = getMainBtn("company.php", "company");
$goToTeam = getMainBtn("team.php", "team");
$body = "
<body>
    

   
        <div class='row'>

           <div class='card border-0'>
           <div class='card-body '>
            $title
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
       
     
      
</div>
    </body>
";


echo page($navbar, $body);

?>