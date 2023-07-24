<?php

function getNewEventCard($company): string
{
    return <<<HTML
<div id="event-new" class="card problem rounded-4 m-3" style=" width: 330px; cursor: pointer;">
    <div class="card-body p-4 text-center" data-bs-toggle="modal" data-bs-target="#expand-event-new">
        <div class="card-title m-0 d-flex justify-content-between">
            
        </div>
        
        <i class="fa fa-plus fa-3x text-primary"></i>
        
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal" id="expand-event-new" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title ms-5" >New event by {$company['name']}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <!-- Place the expanded content here -->
                    <img class="float-left col-md-5  m-0 p-0 rounded-4 m-2" src="" alt="customisation in progress" width="400px" height="400px" style="object-fit: cover; border: 1px solid #a6a4a4;">
                    
                    <fieldset class="col-md-6 p-5 text-left" style="height: 415px; overflow-y: scroll;"> 
                        
                        
                        <label for="event-date-new" class="ms-3">When:</label>
                        <input id="event-date-new" name="eventDate" class="form-control" type="date"  required/>
                        
                        <label for="event-description-new" class="ms-3 mt-3">Description: </label>
                        <textarea id="event-description-new" name="description" class="bg-white  text-muted form-control" required></textarea>
                        <label for="event-duration-new" class="ms-3 mt-3">Duration: </label>
                        <input id="event-duration-new" name="duration" type="text"  class="bg-white  text-muted form-control" value="" placeholder="Duration:" required/>
                        <label for="event-amount-new" class="ms-3 mt-3">Member amount: </label>
                        <input id="event-amount-new" name="amount" type="number"  class="bg-white  text-muted form-control" value="" placeholder="Amount:" required/>
                        
                    </fieldset>
                
                
                <!-- You can use the same HTML as the original card or modify it as needed -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="update-event-new" type="button" class="btn btn-outline-primary">Create</button>
                <!-- Add additional buttons or actions if needed -->
            </div>
            <script> 
                $('#update-event-new').on('click', function () {
                    
                    var values = $('#expand-event-new').find('.form-control').map((_, el)=> el.value).get();
                   
                    
                    const notEmpty = (it) => it !== "";
                    if (values.every(notEmpty)) {
                        $.post("../process/create_event.php", {companyId: '{$company["id"]}', values: values}, function (data) {
                        var response = JSON.parse(data);
                        
                        
                        if (response.status === 'success') {
                            $('#text-new').html(values[1]);
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
                        setTimeout(function () {
                        document.location.href = '/WAT/pages/dashboard_company.php';
                    }, 1000);
                    })

                    } else {
                        $('#error__card').fadeIn(0);
                        $('#error__title').html("Please fill in all fields.");
                        setTimeout(function () {
                          $('#error__card').fadeOut(500);
                          }, 5000) // show response from the php script.
                          
                          setTimeout(function () {
                        document.location.href = '/WAT/pages/dashboard_company.php';
                    }, 1000);
                        }
                })
            </script>
        </div>
    </div>
</div>

HTML;

}

?>