<?php
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/event_card.php";
include "../components/ui.php";
require "../utility.php";



$navbar = returnNavBar(null);
$title = pageTitle("search", "Upcoming events");

//
//$filters = <<<HTML
//    <div class="bg-transparent p-1 rounded-5">
//        <button name="filterBtn" onclick="searchByKeyword('cloud')" class="btn btn-outline-primary"><i class="fa fa-cloud"></i></button>
//        <button name="filterBtn" onclick="searchByKeyword('social')" class="btn btn-outline-warning"><i class="fa fa-people-group"></i></button>
//        <button name="filterBtn" onclick="searchByKeyword('clean')" class="btn btn-outline-success"><i class="fa fa-leaf"></i></button>
//        <button name="filterBtn" onclick="searchByKeyword('health')" class="btn btn-outline-danger"><i class="fa fa-star-of-life"></i></button>
//    </div>
//
//
//    <script>
//    <!--  filter btns logic -->
//    </script>
//HTML;
//
//
//
//$c1 = getProblemCard("HTG LLC",95,"€ 10,000 / project","149 New Montgomery", "San Francisco, CA","Setup an infrastructure, using AWS.", "DevOps Outsource", "Cloud", "primary", "cloud");
//$c2 = getProblemCard("EU",100,"€ 3,000 / member","Shoreditch, Montacute Yards", "London, GB","Training, practical experience and career support.", "Law Conference", "Social", "warning", "people-group");
//$c3 = getProblemCard("Jeez Trains",80,"€ 30,000 / project","C", "Munich, Germany","Train Environment recognition Model using RL approach.", "ML Internship", "Clean Tech", "success", "leaf");
//$c4 = getProblemCard("HTG LLC",90,"€ 300,000 / project","D", "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Hackathon", "Health Tech", "danger", "star-of-life");
//$c5 = getProblemCard("G-Health LLC",70,"€ 300,000 / project",null, "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Outsource", "Health Tech", "danger", "star-of-life");
//$c6 = getProblemCard("CNC LTD",75,"€ 300,000 / project",null, "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Internship", "Health Tech", "danger", "star-of-life");
//$c7 = getProblemCard("HTG LLC",95,"€ 10,000 / project","Remote", "San Francisco, CA","Setup an infrastructure, using AWS.", "CI/CD", "Cloud", "primary", "cloud");
//$c8 = getProblemCard("EU",100,"€ 3,000 / member",null, "London, GB","Training, practical experience and career support.", "Law Conference", "Social", "warning", "people-group");
//$body = <<<HTML
//
//   $title
//
//    <script>
//
//    function filterCards(value) {
//        $(".problem").filter(function() {
//          var hasValue = $(this).text().toLowerCase().indexOf(value) > -1;
//          $(this).toggle(hasValue);
//        });
//    }
//
//    $(document).ready(function(){
//      setupCards();
//      $("#myInput").on("keyup", function() {
//        var value = $(this).val().toLowerCase().trim();
//        setupCards();
//        filterCards(value);
//      });
//    });
//
//
//    function searchByKeyword(keyword) {
//        $(document).ready(function(){
//            $("#myInput").val(keyword)
//            filterCards(keyword);
//            setupCards();
//          });
//
//    }
//    </script>
//
//    <div class="col sticky-top p-2 mt-2 d-flex flex-wrap justify-content-center text-center">
//
//        <input class="col-3 bg-white p-1 border-1 rounded-left text-center align-content-center" id="myInput" type="text" placeholder="Search..">
//        <button onclick="searchByKeyword('')" class="bg-white btn-secondary text-bg-light border-1 rounded-right mr-2 align-middle"><i class="fa fa-times"></i></button>
//
//
//        $filters
//    </div>
//
//
//   <div class="d-flex flex-wrap justify-content-center" id="myDIV">
//        $c1
//        $c2
//        $c3
//        $c4
//        $c5
//        $c6
//        $c7
//        $c8
//   </div>
//
//HTML;






$id = $_SESSION['userId'];

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
//    $events = $db->where('company_id', $company['id'])->get('event');

    $company_id = $company['id'];
// Construct the join table query
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

<label for="search" class="ms-5">Search:</label>
<input type="text" id="search" placeholder="Enter keywords">
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