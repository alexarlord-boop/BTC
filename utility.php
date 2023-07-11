<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once ('PHP-MySQLi-Database-Class-master/MysqliDb.php');
require_once "components/ui.php";

$host = 'localhost:3306';
$user = 'root';
$password = '';
$dbname = 'btcdb';

global $db;
$db = new MysqliDb ($host, $user, $password, $dbname);

try {
    $query = $db->get('user'); //will contain an Array of all users;
//    pre($query); // test query result
} catch (mysqli_sql_exception $e) {
    // log the exception message, filename and line number
    echo $e->getMessage();
    echo $db->getLastError();
    echo $e;
}
function pre($data) {
    print '<pre>' . print_r($data, true) . '</pre>';
}

function getRoleIds($array) {
    $roleIds = [];
    foreach ($array as $item) {
        if (isset($item['role_id'])) {
            $roleIds[] = $item['role_id'];
        }
    }
    sort($roleIds);
    return $roleIds;
}


function redirect($url)
{
    if (headers_sent()) {
        // If headers have already been sent, use a JavaScript redirect
        echo '<script>window.location = "' . $url . '";</script>';
    } else {
        // If headers have not been sent, use a PHP redirect
        header('Location: ' . $url);
        exit;
    }
}



function page($navbar, $body) {
    $roles = $_SESSION['roles'];
    $roleSwitch = getRoleSwitch($roles);

    $email = $_SESSION['email'];
    $fullName = $_SESSION['fullName'];
    $avatar = ($_SESSION['avatar'] === "") ? "../img/avatar.jpeg" : $_SESSION['avatar'];

    return <<<HTML
            <!doctype html>
            <html lang="en">
            
            <body>
                $navbar
                    
                <div class="col-12 mt-2">
                    $body
                </div>
                
                <!-- FOOTER -->
                <div class="container align-bottom">
                <!-- FOOTER end -->
                      
                      <footer class="">
                       

                        <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                          <p>© 2022 Company, Inc. All rights reserved.</p>
                          

                          <ul class="list-unstyled d-flex">
                            <li class="ms-3"><a class="" href="login.php"><svg class="bi" width="24" height="24"></svg>login</a></li>
                            <li class="ms-3"><a class="" href="#"><svg class="bi" width="24" height="24"></svg>link</a></li>
                            <li class="ms-3"><a class="" href="#"><svg class="bi" width="24" height="24"></svg>link</a></li>
                          </ul>
                        </div>
                        <img src='../animations/credits.gif' height='500' width='2000' style='height: 100px; position: relative; bottom: 10px; object-fit: cover; z-index: -1;'/>
                        

                      </footer>
                </div>
                
                 
                <!-- OFFCANVAS -->
                <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasWithBothOptionsLabel">
                  <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body h-100" style="z-index: 10;">
                  
                    <!-- Profile info -->
                    <div class="card border-dark border-3 mb-5" style="border-radius: 15px;">
                          <div class="card-title d-flex justify-content-between"> 
                            <p class="ms-2 mt-2">$roleSwitch</p>
                            <button type="button" title="Settings" class="btn btn-outline-secondary rounded-circle p-2 mt-1 mr-1">
                              <i class="fa fa-cog"></i>
                            </button>
                          </div>
                                      <div class="card-body text-center justify-content-center align-items-center">
                                        <div class="mt-3 mb-4">
                                          <img src="{$avatar}" class="rounded-circle img-fluid mx-auto" style="width: 150px; height: 150px; object-fit: cover;" />
                                        </div>
                                        <h4 class="mb-2">$fullName</h4>
                                        <p class="text-muted mb-4"><a href="#!">$email</a></p>
                                       
                                        <div class="mb-4 pb-2">
                                          
                                        </div>
                                        <button type="button" class="btn btn-primary btn-rounded btn-lg">
                                          Go to Dashboard
                                        </button>
                                        <div class="d-flex justify-content-between text-center mt-5 mb-2">
                                          <div>
                                            <p class="mb-2 h5">8471</p>
                                            <p class="text-muted mb-0">Wallets Balance</p>
                                          </div>
                                          <div class="px-3">
                                            <p class="mb-2 h5">8512</p>
                                            <p class="text-muted mb-0">Income amounts</p>
                                          </div>
                                          <div>
                                            <p class="mb-2 h5">4751</p>
                                            <p class="text-muted mb-0">Total Transactions</p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                    <!-- Profile info end -->
                              
                    <!-- Interaction (subscription) -->
                    <div class="col-md-12 mb-5">
                            <form>
                              <h5>Subscribe to our newsletter</h5>
                              <p>Monthly digest of what's new and exciting from us.</p>
                              <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                                <label for="newsletter1" class="visually-hidden">Email address</label>
                                <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                                <button class="btn btn-primary" type="button">Subscribe</button>
                              </div>
                            </form>
                          </div>
                    <!-- Interaction (subscription) end -->
                        
                    <!-- Links -->  
                    <div class="row">
                            <div class="col-2 mt-3 text-right">
                            <h5>Section</h5>
                            <ul class="nav flex-column">
                              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                            </ul>
                          </div>
                            <img src='../animations/flash.gif' class="col-8 offset-1 mt-5" height='150' width='400' style=' object-fit: fill; z-index: -1;'/>

                          </div>
                    <!-- Links end -->  
                          
                  </div>
                        
                  </div>
                </div>              
                  
                  
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
            </body>
            </html>
HTML;

}

function pageTitle($icon, $text) {
    return <<<HTML
        <h1 class="display-6 text-center mt-4 p-3"><i class="fa fa-$icon"></i> $text</h1>
HTML;

}

function getPointers()
{

    return array(
        'team' => array(
            'title' => "Problems",
            'lnk' => "all_events.php",
            'dash' => 'team.php'
        ),
        'company' => array(
            'title' => "Teams",
            'lnk' => "all_teams.php",
            'dash' => 'company.php'
        ),
//        'coordinator' => array(
//            'title' => "Events",
//            'lnk' => "all_events.php",
//            'dash' => 'coordinator.php'
//        )
    );

}
?>