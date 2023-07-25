<?php
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/event_card.php";
include "../components/ui.php";
require "../utility.php";



$navbar = returnNavBar(null);
$title = pageTitle("search", "Upcoming events");




$companies = $db->get('company_info');

/* Events Data */
$allEvents = array(); // Array to store events from all companies
// Define aliases for the joined fields
$alias_business_field = 'business_field';
$alias_purpose = 'purpose';
$events_table = 'event';
$business_field_table = 'business_field';
$purpose_table = 'purpose';


foreach ($companies as $company) {
    $company_id = $company['id'];

    $db->join($business_field_table, "{$events_table}.business_field_id = {$business_field_table}.id", "LEFT");
    $db->join($purpose_table, "{$events_table}.purpose_id = {$purpose_table}.id", "LEFT");
    $db->where("{$events_table}.company_id", $company_id);
    $events = $db->get($events_table, null, [
        "{$events_table}.*",
        "{$business_field_table}.name AS {$alias_business_field}",
        "{$purpose_table}.name AS {$alias_purpose}"
    ]);


    foreach ($events as &$card) {
        $card = getProblemCard($card['id'], $company, 10, $card['reward'], $company['country'] . '. ' . $company['city'], $card['place'], $card['description'], $card['name'], 'type', 'primary', $card);
    }
    $allEvents = array_merge($allEvents, $events);
}
$events = join($allEvents);
/* Events Data */

//$content = getUnderConstruction();
$content = <<<HTML

<div class="d-flex flex-wrap justify-content-start align-items-start">
$events
</div>
HTML;

$filter = <<<HTML
<p class="my-3"></p>
<div class="col-12 text-center">

<input type="text" id="search" class="form-control col-2 d-inline-block" placeholder="Enter keywords">
<span id="clearIcon" class="me-5" style="cursor: pointer;">&#10006;</span>

<select id="business-field">
    <option value="">All fields</option>
    <option value="Consulting">Consulting</option>
    <option value="Health">Health</option>
    <option value="Clean">CleanTech</option>
    <option value="Social">Social</option>
</select>
<select id="purpose">
    <option value="">All types</option>
    <option value="Internship">Internship</option>
    <option value="Conference">Conference</option>
    <option value="Hackathon">Hackathon</option>
    <option value="Outsource">Outsource</option>
</select>
</div>
<p class="my-2"></p>

  <script>
    
    function filterCards(value) {
        var keywords = value.split(" ");
        
        $(".problem").each(function() {
          var text = $(this).text();
          var hasAllKeywords = keywords.every(keyword => text.includes(keyword));
          $(this).toggle(hasAllKeywords);
        });

    }
    
    $(document).ready(function(){
       var clearIcon = $("#clearIcon");
       let s =  $('#search');
       
       clearIcon.on("click", function() {
        s.val("");
        $('#business-field option[value=""]').attr("selected",true);
        $('#purpose option[value=""]').attr("selected",true);
        
        $(".problem").show(); // Show all elements with class "problem" again
      });
        
       $('#business-field').on('change', function() {
           
           let newKey = $(this).find(":selected").val();
          
               let p = s.val().split(" ")[1];
               s.val(newKey + " " + (p ? p : ""));
           
           
            s.trigger('input');
        });
       
       $('#purpose').on('change', function() {
           
           let newKey = $(this).find(":selected").val();
          
               let f = s.val().split(" ")[0];
               s.val((f ? f : "") + " " + newKey);
           
           
            s.trigger('input');
        });
        
      $("#search").on("input", function() {
        var value = $(this).val().trim();
        console.log(value);
        filterCards(value);
      });
      
    }); 
    

    function searchByKeyword(keyword) {
        $(document).ready(function(){
            $("#search").val(keyword)
            filterCards(keyword);
           
          });

    }
    </script>

HTML;



$body = <<<HTML
                
            $title
            
            $filter
            <div id="event-container"> 
                $content
            </div>

HTML;


echo page($navbar, $body);

?>