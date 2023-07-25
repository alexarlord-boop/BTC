<?php
//
//include "../components/navbar.php";
//include "../components/head_template.php";

//require "../utility.php";


function getProblemCard($eventId, $company, $percent, $fond, $platform, $place, $text, $name, $type, $color, $card, $companyView=false) {
// Check the value of the session variable
    if (isset($_SESSION['userId'])) {
        $disabled = $GLOBALS['roleIdToName'][$_SESSION['currentRole']] === 'company' && ($companyView === true);
    } else {
        $disabled = true;
    }

// Set the disabled attribute value based on the session variable
    $disabledAttribute = $disabled ? '' : 'disabled';
    $showUpdateBtn = $disabled ? '<button id="update-event-' . $eventId . '" type="button" class="btn btn-outline-primary">Update</button>' : '';
    $showDeleteBtn = $disabled ? '<button id="delete-event-' . $eventId . '" type="button" class="btn btn-outline-danger">Delete</button>' : '';

    $date = explode( ' ', $card['date'])[0];



    return <<<HTML
<style>
.problem {
 transition: box-shadow .3s;
}
.problem:hover {

    box-shadow: 0 0 11px rgba(33,33,33,.2); 
}
</style>

<div id="event-{$eventId}" class="card problem rounded-4 m-3" style=" width: 330px; cursor: pointer;">
    <div class="card-body p-4" data-bs-toggle="modal" data-bs-target="#expand-event-{$eventId}">
        <div class="card-title m-0 d-flex justify-content-between">
            <img class="float-left" src="{$card['cover_img']}" width="140px" height="140px" style="object-fit: cover; border: 1px solid #a6a4a4; border-radius: 0 0 50px 0">
          
            
            <div class="justify-content-between flex-column">
                <p class="fs-6 text-secondary text-right">$place</p>
                <p class="fs-6 text-secondary text-right"></p>
            </div>
        </div>
        <div class="card-text h5">
            <p class="fs-6 text-primary text-right align-text-bottom">{$card['business_field']}</p>
            <p class="fs-4 text-primary text-right align-text-bottom">$name</p>
            <p class="h6 fs-8 pb-4 font-weight-light text-primary text-right">{$card['purpose']} by {$company['name']}</p>
            <p class="text-primary"><span class="text-secondary">Fund:</span> € $fond</p>
            <p class="text-primary"><span class="text-secondary">Compatibility:</span> $percent%</p>
            <div id="text-{$eventId}" class="pt-3" style=" text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">$text</div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal" id="expand-event-{$eventId}" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title ms-5" >{$card['purpose']} by {$company['name']}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <!-- Place the expanded content here -->
                    <img class="float-left col-md-5  m-0 p-0 rounded-4 m-2" src="{$card['cover_img']}" width="400px" height="400px" style="object-fit: cover; border: 1px solid #a6a4a4;">
                    
                    <fieldset class="col-md-6 p-5 text-left" {$disabledAttribute} style="height: 415px; overflow-y: scroll;"> 
                        
                        
                        <label for="event-date-{$eventId}" class="ms-3">When:</label>
                        <input id="event-date-{$eventId}" name="eventDate" class="form-control" type="date" value="{$date}"  required/>
                        
                        <label for="event-description-{$eventId}" class="ms-3 mt-3">Description: </label>
                        <textarea id="event-description-{$eventId}" name="description" class="bg-white  text-muted form-control" required>{$card['description']}</textarea>
                        <label for="event-duration-{$eventId}" class="ms-3 mt-3">Duration: </label>
                        <input id="event-duration-{$eventId}" name="duration" type="text"  class="bg-white  text-muted form-control" value="{$card['duration']}" placeholder="Duration:" required/>
                        <label for="event-amount-{$eventId}" class="ms-3 mt-3">Member amount: </label>
                        <input id="event-amount-{$eventId}" name="amount" type="number"  class="bg-white  text-muted form-control" value="{$card['amount']}" placeholder="Amount:" required/>
                        
                    </fieldset>
                
                
                <!-- You can use the same HTML as the original card or modify it as needed -->
            </div>
            <div class="modal-footer">
                
                $showUpdateBtn
                $showDeleteBtn
                <!-- Add additional buttons or actions if needed -->
            </div>
            <script> 
                $('#update-event-{$eventId}').on('click', function () {
                    
                    var values = $('#expand-event-{$eventId}').find('.form-control').map((_, el)=> el.value).get();
                    
                    
                    const notEmpty = (it) => it !== "";
                    if (values.every(notEmpty)) {
                        $.post("../process/update_event.php", {eventId: '$eventId', values: values}, function (data) {
                            var response = JSON.parse(data);
                            
                            
                            if (response.status === 'success') {
                                $('#text-{$eventId}').html(values[1]);
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
                     
                    

                    } else {
                        $('#error__card').fadeIn(0);
                        $('#error__title').html("Please fill in all fields.");
                        setTimeout(function () {
                          $('#error__card').fadeOut(500);
                          }, 5000) // show response from the php script.
                        }
                    
          
                    setTimeout(function () {
                        document.location.href = '/WAT/pages/dashboard_company.php';
                    }, 1000);
                })
                
                $('#delete-event-{$eventId}').on('click', function () {
                  
                    $.post("../process/delete_event.php", {eventId: '$eventId', companyId: '{$company["id"]}'}, function (data) {
                        var response = JSON.parse(data);
                     
                        
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
                    })
                    
                    setTimeout(function () {
                        document.location.href = '/WAT/pages/dashboard_company.php';
                    }, 1000);


                })
            </script>
        </div>
    </div>
</div>


HTML;

}

//$c1 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "primary", "star-of-life");
//$c2 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "success", "star-of-life");
//$c3 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "warning", "star-of-life");
//$c4 = getProblemCard("HTG LLC",95,"€ 300.000", "Munich Arena", "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Hackathon", "Health Tech", "danger", "star-of-life");
//$body = <<<HTML
//    <div class="d-flex flex-wrap justify-content-center">
//
//        $c4
//</div>
//HTML;
//
//
//
//echo page("", $body)

?>