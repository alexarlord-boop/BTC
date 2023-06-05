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
           <div class='card-body'>
           <h2>This is a Business to Teams connector.</h2>
           <p class='mt-5'></p>
           <h2>Find allocated teams.</h2>
           <h2>Save time on stuffing.</h2>
           <h2>Save money choosing multiskill enthusiasts.</h2>
            </div>   
                
       
</div>
            <div class='col-12 text-center mt-5'>
                 <form class='form-group col' method='post' action='../login_process.php'>
                
                   
                    <div class='card-body'>
                        <div class='row d-inline-flex'>
                        <h2 class='text-primary'>Explore as a</h2>
                        <select id='selector' class='input h4 w-100 text-center' name='type'>
                            <option  value='0'>Company</option>
                            <option  value='1'>Team</option>
                            <option  value='2'>Coordinator</option>
                        </select>
                        </div>
                        
                        <button type='submit' id='submit' class='m-5 p-5 btn display-6 btn-outline-primary'>Go!</button>
                    </div>
                    
                 
              
                </form>
            </div>
       
     
      
</div>
    </body>
";


echo page($navbar, $body);

?>