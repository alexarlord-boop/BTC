<?php
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/ui.php";
require "../utility.php";


$avatarInput = getImageInput();
echo <<<HTML

<section class="h-100 gradient-form" style="background-color: #f3f3f3;">
<!--
<section class="h-100 gradient-form" style="background-image: url('../animations/back.gif'); background-size: 2000px; background-position: center; background-position-y: -50px; background-position-x: 85px;">
-->
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          
           <form method="post" action="../process/signup_process.php" enctype="multipart/form-data" class="row g-0 m-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <i class="far fa-compass fa-5x"></i>
                  <h4 class="mt-1 mb-5 pb-1">We are The BTC Team</h4>
                </div>

               
                  <p class="my-2">Create your account</p>

                  <div class="row"> 
                    <div class="form-outline col-md-6 mb-4">
                    <input type="text" id="name" name="name" class="form-control"
                      placeholder="Your name" required/>
                    <label class="form-label" for="name">Name</label>
                  </div>
                  
                  <div class="form-outline col-md-6 mb-4">
                    <input type="text" id="surname" name="surname" class="form-control"
                      placeholder="Your surname" required/>
                    <label class="form-label" for="surname">Surname</label>
                  </div>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control"
                      placeholder="Email address" required/>
                    <label class="form-label" for="email">Email</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" required/>
                    <label class="form-label" for="password">Password</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-block gradient-custom-2 mb-3" id="submit" type="submit">Create Account</button>
                    <!--<a class="text-muted" href="#!">Forgot password?</a>-->
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Already have an account?</p>
                    <button onclick="window.location.href = '../pages/login.php'" type="button" class="btn btn-outline-danger">Log in</button>
                  </div>

   

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Optional information</h4>
                <p class="small mb-0"></p>
              
              <p class="my-5"></p>
              
              <div class="row"> 
                  $avatarInput
                  
                  <p class="my-5"></p>
                  
                  <div class="row"> 
                    <div class="form-outline col-md-6 mb-4">
                    <input type="text" id="country" name="country" class="form-control"
                      placeholder="Your country"/>
                    <label class="form-label" for="country">Country</label>
                  </div>
                  
                  <div class="form-outline col-md-6 mb-4">
                    <input type="text" id="city" name="city" class="form-control"
                      placeholder="Your city"/>
                    <label class="form-label" for="city">City</label>
                  </div>
                  </div>
                  
                  <h4 class="text-center mb-2">Your role</h4>
                  <div class="row col-md-8 offset-md-2">
                      <input type="radio" class="btn-check" id="option0" name="option" value="visitor" autocomplete="off" checked required/>
                      <label class="btn btn-white" for="option0">Visitor</label>
                      
                      <input type="radio" class="btn-check" id="option1" name="option" value="company" autocomplete="off"  />
                      <label class="btn btn-white" for="option1">Company</label>
                    
                      <input type="radio" class="btn-check" id="option2" name="option" value="member" autocomplete="off" />
                      <label class="btn btn-white" for="option2">Team member</label>
                    </div>

                  </div>
              </div>
              
              
            </div>
            </form>
          
        </div>
      </div>
    </div>
  </div>
</section>

<script>
    $('#submit').on('click', function () {
        
    })
</script>
HTML;

?>