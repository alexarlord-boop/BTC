<?php

session_start();
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/ui.php";
require_once "../utility.php";

$navbar = returnNavBar(null);
$title = pageTitle("cog", "Settings");

$success = getSuccessInfo();
$error = getErrorInfo();
$info = getUnderConstruction();

$js_roleIds = json_encode($_SESSION['roles']);



$id = $_SESSION['userId'];
$db->where('id',$id);
$userData = $db->getOne('user');
$avatarInput = getImageInput($url=$userData['avatar_img'], 'New image url');


/* Member Data */

$db->where('user_id', $_SESSION['userId']);
$mem = $db->getOne('user_member');
$infoId = $mem['member_info_id'];
$mem_user = $db->where('id', $mem['user_id'])->getOne('user');
$mem_info = $db->where('id', $mem['member_info_id'])->getOne('member_info');

$member = array('user_info'=> $mem_user, 'member_info' => $mem_info);

/* Member Data */



/* Company Data */
$companyInfoId = $db->where('user_id', $id)->getOne('user_company')['company_info_id'];
$companyData = $db->where('id', $companyInfoId)->getOne('company_info');
/* Company Data */

$roleBasedData = <<<HTML
<!-- Company Data -->
<div id="1" class="role-based-data card col-md-8 offset-md-2 border-3 rounded-4 my-5" style="border-color: {$GLOBALS['roleIdToColorList']['1']}">

<div class="card-title text-center display-6 text-primary mt-4">Company data</div>
<div class="card-body">
    <form id="companyDataForm" method="post" action="../process/settings_company_process.php">
        
            <div class="row"> 
                <div class="form-outline col-md-4 mb-4">
                    <input type="text" id="company-name" name="name" class="form-control text-primary"
                      value="{$companyData['name']}"
                      placeholder="Your name" required/>
                    <label class="form-label" for="name">Name</label>
                  </div>
                  
                <div class="form-outline col-md-4 mb-4">
                <input type="text" id="company-country" name="country" class="form-control text-primary"
                  value="{$companyData['country']}"
                  placeholder="Your country"/>
                <label class="form-label" for="country">Country</label>
                </div>
                <div class="form-outline col-md-4 mb-4">
                <input type="text" id="company-city" name="city" class="form-control text-primary"
                  value="{$companyData['city']}"
                  placeholder="Your city"/>
                <label class="form-label" for="city">City</label>
              </div>
            </div>
            <div class="row text-center mt-3">
                <div><button type="submit" class="btn btn-outline-primary text-center">Update</button></div>
            </div>
    </form>
</div>
<script>
$("#companyDataForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var actionUrl = form.attr('action');
    
    let name = form.find('input[name="name"]').val();
    let country = form.find('input[name="country"]').val();
    let city = form.find('input[name="city"]').val();
    
    
    $.post(actionUrl, {userId: '$id', name: name, country: country, city: city}, function (data) {
        var response = JSON.parse(data); // Parse the JSON response
        console.log(response);
        
        if (response.status === 'success') {
            $('#success__card').fadeIn(0);
            setTimeout(function () {
              $('#success__card').fadeOut(500);
              }, 5000) // show response from the php script.
              $('#success__title').html(response.message);
        } else if (response.status === 'error') {
             $('#error__card').fadeIn(0);
             setTimeout(function () {
              $('#error__card').fadeOut(500);
              }) // show response from the php script.
              $('#error__title').html(response.data);
        }
    });
});
</script>
</div>
<!-- Company Data END -->

<!-- Team member Data -->
<style>

input[type="range"] {
  -webkit-appearance: none;
  margin-right: 15px;
  width: 200px;
  height: 3px;
  background: rgba(255, 255, 255, 0.6);
  border-radius: 5px;
  background-image: linear-gradient(#ff4500, #ff4500);
  background-size: 70% 100%;
  background-repeat: no-repeat;
}

input[type="range"]::-webkit-slider-thumb {
  -webkit-appearance: none;
  height: 16px;
  width: 16px;
  border-radius: 50%;
  background: dodgerblue;
  cursor: ew-resize;
  box-shadow: 0 0 2px 0 #555;
  transition: background .3s ease-in-out;
}

input[type=range]::-webkit-slider-runnable-track  {
  -webkit-appearance: none;
  box-shadow: none;
  border: none;
  background: #20c997;
}
</style>
<div id="2" class="role-based-data card col-md-8 offset-md-2 border-3 rounded-4 my-5" style="border-color: {$GLOBALS['roleIdToColorList']['2']}">

<div class="card-title text-center display-6 text-primary mt-4">Skills</div>
<div class="card-body">
    <form id="memberDataForm" method="post" action="../process/settings_member_process.php">
        <div class="d-flex"> 
            
        <div class="col-6 p-1 border-right"> 
            <label for="range1" class="col-4 form-label">Backend</label> <span id="label-1" class="col-2 text-primary">{$mem_info['backend']}</span>%
            <input type="range" class="col-6  form-range" min="0" max="100" step="1" value="{$mem_info['backend']}" id="range-1">
           
            <label for="range2" class="col-4 form-label">Frontend</label> <span id="label-2" class="col-2 text-primary">{$mem_info['frontend']}</span>%
            <input type="range" class="col-6 form-range" min="0" max="100" step="1" value="{$mem_info['frontend']}" id="range-2">
           
            <label for="range3" class="col-4 form-label">Analytics</label> <span id="label-3" class="col-2 text-primary">{$mem_info['analytics']}</span>%
            <input type="range" class="col-6 form-range" min="0" max="100" step="1" value="{$mem_info['analytics']}" id="range-3">
        </div> 
        
        <div class="col-6 p-1"> 
            <label for="range4" class="col-4 form-label">Management</label> <span id="label-4" class=" col-2  text-primary">{$mem_info['management']}</span>%
            <input type="range" class="col-6 form-range" min="0" max="100" step="1" value="{$mem_info['management']}" id="range-4">
            <label for="range5" class="col-4 form-label">Design</label> <span id="label-5" class="col-2  text-primary">{$mem_info['design']}</span>%
            <input type="range" class="col-6 form-range" min="0" max="100" step="1" value="{$mem_info['design']}" id="range-5">
            <label for="range6" class="col-4 form-label">Databases</label> <span id="label-6" class=" col-2 text-primary">{$mem_info['db']}</span>%
            <input type="range" class="col-6 form-range" min="0" max="100" step="1" value="{$mem_info['db']}" id="range-6">
        </div>
        
        
        </div>
        <div class="row text-center mt-3">
            <div><button type="submit" class="btn btn-outline-primary text-center">Update</button></div>
        </div>
    </form>
</div>
<script>
$(document).ready(function () {
    
    $('.form-range').each(function () {
        $(this).on('input', function () {
            let id = $(this).attr('id').split('-')[1];
            $('#label-' + id).html($(this).val());
        })
    });
    
    
    $.get("../process/user_info.php/?id=$id", function (data) {
        var response = JSON.parse(data); // Parse the JSON response
        $("#profile-card").css('border-color', response.color);
        $("#role-based-settings-card").css('border-color', response.color);
        
    });
});

$("#memberDataForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var actionUrl = form.attr('action');
    
    let range1 = $('#range-1');
    let range2 = $('#range-2');
    let range3 = $('#range-3');
    let range4 = $('#range-4');
    let range5 = $('#range-5');
    let range6 = $('#range-6');
    
    const skills = {
        'backend': range1.val(),
        'frontend': range2.val(),
        'analytics': range3.val(),
        'management': range4.val(),
        'design': range5.val(),
        'db': range6.val()
    };
    
    
    
    $.post(actionUrl, {userId: '$id', infoId: '$infoId', skills: skills}, function (data) {
        var response = JSON.parse(data); // Parse the JSON response
        console.log(response);
        
        if (response.status === 'success') {
            $('#success__card').fadeIn(0);
            setTimeout(function () {
              $('#success__card').fadeOut(500);
              }, 5000) // show response from the php script.
              $('#success__title').html(response.message);
        } else if (response.status === 'error') {
             $('#error__card').fadeIn(0);
             setTimeout(function () {
              $('#error__card').fadeOut(500);
              }) // show response from the php script.
              $('#error__title').html(response.data);
        }
    });
});
</script>
</div>
<!-- Team member Data END -->

<!-- Admin Data -->
<div id="3" class="role-based-data card col-md-8 offset-md-2 border-3 rounded-4 my-5" style="border-color: {$GLOBALS['roleIdToColorList']['3']}">

<div class="card-title text-center display-6 text-primary mt-4">Admin data</div>
<div class="card-body">
    <form method="post" action="../process/settings_default_process.php">
       
         <!-- Role list -->
         <div class="d-flex flex-wrap align-items-center align-middle justify-content-around">
         
         <p class="my-5"></p>
         <div class="fs-5 d-inline-flex">Amend your role list:</div>
         <div class="btn-group" role="group" aria-label="Role list">
          <input type="checkbox" class="btn-check" title="Default role" id="btncheck-4" autocomplete="off">
          <label class="btn btn-outline-primary" for="btncheck-4">Visitor</label>
          
          <input type="checkbox" class="btn-check" id="btncheck-1" autocomplete="off">
          <label class="btn btn-outline-primary" for="btncheck-1">Company</label>
        
          <input type="checkbox" class="btn-check" id="btncheck-2" autocomplete="off">
          <label class="btn btn-outline-primary" for="btncheck-2">Team member</label>
        
          <input type="checkbox" class="btn-check" disabled id="btncheck-3" autocomplete="off">
          <label class="btn btn-outline-primary" for="btncheck-3">Admin</label>
        </div>
           
        </div>
         <!-- Role list -->
  
    </form>
</div>
<script>
$(document).ready(function () {
    
    let roleIds = $js_roleIds;
    roleIds.forEach(function (e) {
        $('#btncheck-' + e).attr('checked', 'checked');
    })

    $('*[id*=btncheck]').each(function () {
        $(this).on('click', function () {
            let role_id = $(this).attr('id').split('-')[1];
            let to_set = $(this).is(':checked')
            console.log(role_id, to_set);
            
            $.post("../process/update_role.php", { userId: '$id', roleId: role_id, toSet: to_set}, function (data) {
                var response = JSON.parse(data); // Parse the JSON response
                console.log(response);
                if (response.message === 'success') {
                    $('#success__card').fadeIn(0);
                      setTimeout(function () {
                          $('#success__card').fadeOut(500);
                      }, 5000) // show response from the php script.
                      $('#success__title').html(response.data);
                } else {
                    $('#error__card').fadeIn(0);
                  setTimeout(function () {
                      $('#error__card').fadeOut(500);
                  }, 5000) // show response from the php script.
                  $('#error__title').html(response.data);
                }
            })
            

        
    })
    
})
    
});
</script>
</div>
<!-- Admin Data END -->

<!-- Visitor Data -->
<div id="4" class="role-based-data card col-md-8 offset-md-2 border-3 rounded-4 my-5" style="border-color: {$GLOBALS['roleIdToColorList']['4']}">

<div class="card-title text-center display-6 text-primary mt-4">Visitor data</div>
<div class="card-body">
    <form method="post" action="../process/settings_default_process.php">
        $info      
    </form>
</div>
</div>
<!-- Visitor Data END -->

<script>
$(document).ready(function () {
    setRoleBasedData({$_SESSION['currentRole']});
})

function setRoleBasedData(currentRole) {
    console.log(currentRole);
    $('.role-based-data').each(function () {
    
    if (parseInt($(this).attr('id')) !== currentRole) {
        $(this).css('display', 'none');
    } else {
        $(this).css('display', 'block');
    }
})
}
</script>
HTML;


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

<!--<div class="col-12 text-center"><p id="roleSwitch" class="ms-2 mt-2">{$_SESSION['roleSwitch']}</p></div>
-->
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

$roleBasedData


HTML;



echo page($navbar, $body);


?>