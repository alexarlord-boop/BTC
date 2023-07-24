<?php

session_start();
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


global $roleIdToColorList;
$roleIdToColorList = array(
    "1"=>"#ffc107",
    "2"=>"#20c997",
    "3"=>"#d63384",
    "4"=>"#6610f2"
);

global $roleIdToName;
$roleIdToName = array(
    "1"=>"company",
    "2"=>"member",
    "3"=>"admin",
    "4"=>"visitor"
);

function setRoleColor() {
    global $roleIdToColorList;
    $roleid = $_SESSION['currentRole'];
    $_SESSION['color'] = $roleIdToColorList[$roleid];
    return $_SESSION['color'];
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
    $userId = $_SESSION['userId'];


    $email = $_SESSION['email'];
    $fullName = $_SESSION['fullName'];
    $avatar = ($_SESSION['avatar'] === "") ? "../img/avatar.jpeg" : $_SESSION['avatar'];

    $settings = ($_SESSION['currentRole'] === '4') ? '' : '<a id="settingsBtn" href="../pages/settings.php"  title="Settings" class="btn btn-outline-secondary rounded-circle p-2 mt-1 mr-1"><i class="fa fa-cog"></i></a>';
    $dashboardBtn = ($_SESSION['currentRole'] === '4') ? '' : '<button id="dashboardBtn" type="button" class="btn btn-primary btn-rounded btn-lg">
          Go to Dashboard
        </button>';

    $label = getLabel(0.4);
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

      
      <footer class="">
       
        <div id="footer-border"  class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
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
<!-- FOOTER end -->

 
<!-- OFFCANVAS -->
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Profile</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body h-100" style="z-index: 10;">
  
  <div id="loading-spinner" style="display: none;">
  <!-- Add your loading spinner HTML code here -->
  bebra
</div>
    <!-- Profile info -->
    <div id="profile-card" class="card  border-3 mb-5" style="border-radius: 15px;">
          <div class="card-title d-flex justify-content-between"> 
            <p id="roleSwitch" class="ms-2 mt-2">{$_SESSION['roleSwitch']}</p>
            $settings
          </div>

      <div class="card-body text-center justify-content-center align-items-center">
        <div class="mt-3 mb-4">
          <img id="avatar-profile" src="{$avatar}" class="rounded-circle img-fluid mx-auto" style="width: 150px; height: 150px; object-fit: cover;" />
        </div>
        <h4 id="name-profile" class="mb-2">name</h4>
        <p class="text-muted mb-4"><a id="email-profile" href="#!">email</a></p>
       
        <div class="mb-4 pb-2">
          
        </div>
        $dashboardBtn
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
            <div style="position: relative; bottom: 0px" >$label</div>
          </div>
    <!-- Links end -->  
          
  </div>
        
  </div>
</div>   
                
<script> 
$(function() {
  // optional: don't cache AJAX to force the content to be fresh
  $.ajaxSetup({
    cache: false
  });

  let name = $('#name-profile');
  let email = $('#email-profile');
  let avatar = $('#avatar-profile');
  let card = $('#profile-card');
  var roleSwitch = $('#roleSwitch');
  let dashBtn = $('#dashboardBtn');

  // Specify the server/url you want to load data from
  var url = "../process/user_info.php/?id=$userId";

  $(document).on('click', '#menuBtn', function() {
    // Show the loading spinner
    $("#loading-spinner").show();

    name.html('loading..').load(url, function(data) {
      // Hide the loading spinner once the content is loaded
      $("#loading-spinner").hide();

      var response = JSON.parse(data); // Parse the JSON response

      name.html(response.data.name + ' ' + response.data.surname);
      email.html(response.data.email);
      avatar.attr('src', response.data.avatar_img);
      card.css('border-color', response.color);
      dashBtn.css('background-color', response.color).click(function() {
        window.location.href = '../pages/dashboard_' + '{$GLOBALS['roleIdToName'][$_SESSION['currentRole']]}' + '.php'
      })
      roleSwitch.html(response.switch);

      
    });
  });
// $("#roleSelect").off("change").on("change", function() {
  $(document).on('change', '#roleSelect', function () {
    let role_id = $(this).val();
    let roleName = $(`#roleSelect option[value=` + role_id + ']').html();

    $('#roleSelect option:eq(' + role_id + ')').prop('selected', true);
    document.location.href = "../pages/main.php";
    /*if (parseInt(role_id) === 4) {
        document.location.href = "../pages/main.php";
        $('#settingsBtn').hide();
    } else {
         $('#settingsBtn').show();
    }*/
    
    $.post("../process/set_role.php", {
      userId: '$userId',
      roleId: role_id,
      roleName: roleName
    }, function(data) {
      var response = JSON.parse(data); // Parse the JSON response

      roleSwitch.html(response.switch);
      card.css('border-color', response.color);
      dashBtn.css('background-color', response.color).click(function() {
        window.location.href = '../pages/dashboard_' + response.roleName + '.php'
      });

      $("#logo").css('background-color', response.color);
      $('#footer-border').css('border-color', response.color);

      if (window.location.href.includes('dashboard')) {
        var current = window.location.href.split('WAT')[1].split('_')[1].split('.')[0];
        if (window.location.href.includes(response.roleName)) {
          $('#' + current + '-dashboard').css({
            'filter': 'blur(0px)',
            'pointer-events': 'auto'
          });
          $('#' + current + '-warning').fadeOut();
        } else {
          $('#' + current + '-dashboard').css({
            'filter': 'blur(10px)',
            'pointer-events': 'none'
          });
          $('#' + current + '-warning').fadeIn(100);
        }
      } else if (window.location.href.includes('settings')) {
        setRoleBasedData(parseInt(role_id));
      }
    });
  });
});

</script>          
  
  
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