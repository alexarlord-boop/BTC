<?php

include "../components/head_template.php";
include "../components/navbar.php";
require "../utility.php";
session_start();
//$_SESSION['userType'] = null;
$_SESSION['title'] = '';
$_SESSION['lnk'] = '';

$navbar = returnNavBar(null);
$body = "
<body>
    

   
        <div class='row'>

           <div class='card border-0'>
           <div class='card-body '>
           <h2>We are = <span class='text-primary'>Business</span> + <span class='text-success'>Teams</span> + <span class='text-warning'>Coordinators</span>.</h2>
           <p class='mt-5'></p>
           <div class='col-12 flex-wrap justify-content-center'>
         
                <h2>Solve realistic problems.</h2>
               <h2>Save time on arranging events.</h2>
               <h2>Search enthusiasts and platforms.</h2>
         
            
            </div>
           </div>
           </div>
           <div class='col-12 text-center mt-5'>
                 <form class='form-group col' method='post' action='../login_process.php'>
                    <div class='card-body'>
                        <div class='row d-inline-flex justify-content-center'>
                        <h2 class='text-primary'>Explore as a</h2>
                        <select id='selector' class='input h4 w-50 text-center' name='type'>
                            <option  value='0'>Company</option>
                            <option  value='1'>Team</option>
                            <option  value='2'>Coordinator</option>
                        </select>
                        </div>
                        
                        <button type='submit' id='submit' class='m-3 p-5 font-weight-bold btn display-6 btn-outline-primary' style='cursor: pointer;'>Go!</button>
                    </div>
                 
              
                </form>
            </div>
       
     
      
</div>
    </body>
";


echo page($navbar, $body);

?>