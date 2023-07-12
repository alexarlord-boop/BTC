<?php

session_start();
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/ui.php";
require_once "../utility.php";

$navbar = returnNavBar(null);
$title = pageTitle("cog", "Settings");

$db->where('id', $_SESSION['userId']);
$userData = $db->getOne('user');
//pre($userData);
$avatarInput = getImageInput($url=$userData['avatar_img'], 'New image url');


$success = '';
$error = '';
if (isset($_SESSION['success'])) {
    $success = getSuccessInfo();
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    $error = getErrorInfo();
    unset($_SESSION['error']);
}


$body = <<<HTML
$title


<div class="card col-md-8 offset-md-2 rounded-4 border-dark my-5">
$success
$error
<div class="card-title text-center display-6 text-primary mt-4">User data</div>

<div class="card-body">
<form method="post" action="../process/settings_default_process.php">
<div class="d-flex">

<!-- Info update -->
<div class="col-8">

    <!-- Email -->
    <div class="row"> 
        <div class="form-outline col-md-6 mb-4">
            
            <input type="email" id="email" name="email" class="form-control text-primary"
              value="{$userData['email']}"
              placeholder="Email address" required/>
              
            <label class="form-label" for="email">Email</label>
          </div>
    </div>
    
    <!-- Name -->
    <div class="row"> 
        <div class="form-outline col-md-6 mb-4">
        <input type="text" id="name" name="name" class="form-control text-primary"
          value="{$userData['name']}"
          placeholder="Your name" required/>
        <label class="form-label" for="name">Name</label>
      </div>
      
      <div class="form-outline col-md-6 mb-4">
        <input type="text" id="surname" name="surname" class="form-control text-primary"
          value="{$userData['surname']}"
          placeholder="Your surname" required/>
        <label class="form-label" for="surname">Surname</label>
      </div>
    </div>
    

    <!-- Location -->
    <div class="row"> 
    <div class="form-outline col-md-6 mb-4">
                    <input type="text" id="country" name="country" class="form-control text-primary"
                      value="{$userData['country']}"
                      placeholder="Your country"/>
                    <label class="form-label" for="country">Country</label>
                    </div>
                    <div class="form-outline col-md-6 mb-4">
                    <input type="text" id="city" name="city" class="form-control text-primary"
                      value="{$userData['city']}"
                      placeholder="Your city"/>
                    <label class="form-label" for="city">City</label>
                  </div>
    </div>
</div>
<!-- Avatar update -->
<div class="col-4 border-left">
$avatarInput
</div>

<div class="row text-center">
<div><button type="submit" class="btn btn-outline-primary text-center">Update</button></div>
</div>
</div>

</form>
</div>
</div>

HTML;


echo page($navbar, $body);


?>