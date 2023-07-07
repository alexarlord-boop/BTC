<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once ('PHP-MySQLi-Database-Class-master/MysqliDb.php');

$host = 'localhost:3306';
$user = 'root';
$password = '';
$dbname = 'btcdb';

global $db;
$db = new MysqliDb ($host, $user, $password, $dbname);

try {
    $query = $db->get('test'); //will contain an Array of all users;
//    pre($query);
} catch (mysqli_sql_exception $e) {
    // log the exception message, filename and line number
    echo $e->getMessage();
    echo $db->getLastError();
    echo $e;
}
function pre($data) {
    print '<pre>' . print_r($data, true) . '</pre>';
}

function page($navbar, $body) {
    return <<<HTML
            <!doctype html>
            <html lang="en">
            
            <body>
                $navbar
                    
                <div class="col-12 mt-2">
                    $body
                </div>
                
                <!-- FOOTER -->
                <div class="container align-">
                      <footer class="">
                        <div class="row">

                        <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                          <p>© 2022 Company, Inc. All rights reserved.</p>
                          <ul class="list-unstyled d-flex">
                            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
                            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
                            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
                          </ul>
                        </div>
                      </footer>
                </div>
                 
                <!-- OFFCANVAS -->
                <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasWithBothOptionsLabel">
                  <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Follow & Support</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                     
                    
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
                          
                          
                          <div class="col-2 mt-5 text-right">
                            <h5>Section</h5>
                            <ul class="nav flex-column">
                              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
                            </ul>
                          </div>
                          
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
            'lnk' => "all_companies.php",
            'dash' => 'team.php'
        ),
        'company' => array(
            'title' => "Teams",
            'lnk' => "all_teams.php",
            'dash' => 'company.php'
        ),
//        'coordinator' => array(
//            'title' => "Events",
//            'lnk' => "all_companies.php",
//            'dash' => 'coordinator.php'
//        )
    );

}
?>