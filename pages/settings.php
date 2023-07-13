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
$id = $userData['id'];
//pre($userData);
$avatarInput = getImageInput($url=$userData['avatar_img'], 'New image url');



$success = getSuccessInfo();
$error = getErrorInfo();



$body = <<<HTML
$title

$success
$error

<!-- Default Data -->
<div class="card col-md-8 offset-md-2 rounded-4 border-3 border-dark my-5">

<div class="card-title text-center display-6 text-primary mt-4">User data</div>
<div class="card-body">
    <form id="defaultDataForm" method="post" action="../process/settings_default_process.php">
        <div class="d-flex">
            
            <!-- Info update -->
            <div class="col-7">
                
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
                
                <!-- Email -->
                <div class="row"> 
                    <div class="form-outline col-md-6 mb-4">
                        
                        <input type="email" id="email" name="email" class="form-control text-primary"
                          value="{$userData['email']}"
                          placeholder="Email address" required/>
                          
                        <label class="form-label" for="email">Email</label>
                      </div>
                </div>
            </div>
            <!-- Avatar update -->
            <div class="col-5 border-left">
            $avatarInput
            </div>
            
            <div class="row text-center mt-3">
            <div><button type="submit" class="btn btn-outline-primary text-center">Update</button></div>
            </div>
        </div>
    </form>
</div>
</div>

<script>
$("#defaultDataForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var actionUrl = form.attr('action');
    
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
          var response = JSON.parse(data); // Parse the JSON response
          $('#success__card').fadeIn(0);
          setTimeout(function () {
              $('#success__card').fadeOut(500);
          }, 5000) // show response from the php script.
          $('#success__title').html(response.data);
        },
        error: function (data) {
          var response = JSON.parse(data); // Parse the JSON response
          $('#error__card').fadeIn(0);
          setTimeout(function () {
              $('#error__card').fadeOut(500);
          }) // show response from the php script.
          $('#error__title').html(response.data);
        }
    });
    
});
</script>
<!-- Default Data END -->




HTML;


        $body .= <<<HTML
<!-- Role-based Data -->
<div id="role-based-settings-card" class="card col-md-8 offset-md-2 border-3 rounded-4 my-5">

<div class="card-title text-center display-6 text-primary mt-4">Role data</div>
<div class="card-body">
    <form method="post" action="../process/settings_default_process.php">
        <div class="d-flex">
            
         
           
        </div>
    </form>
</div>
<script>
$(document).ready(function () {

    $.get("../process/user_info.php/?id=$id", function (data) {
        var response = JSON.parse(data); // Parse the JSON response
        $("#profile-card").css('border-color', response.color);
        $("#role-based-settings-card").css('border-color', response.color);
        
    })
});
</script>
</div>
<!-- Role-based Data END -->
HTML;



echo page($navbar, $body);


?>