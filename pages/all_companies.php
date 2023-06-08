<?php
include "../components/navbar.php";
include "../components/head_template.php";
require "../components/problem_card.php";


session_start();
$user = json_encode($_SESSION['userType']);
$_SESSION['searchFor'] = $_SESSION['userType'];
$navbar = returnNavBar(null);
$title = pageTitle("search", "Realistic Problems");

if ($_SESSION['userType'] !== 'coordinator') {
    $filters = <<<HTML
        <div class="bg-transparent p-1 rounded-5">
            <button onclick="searchByKeyword('cloud')" class="bg-white text-bg-light btn btn-outline-primary"><i class="fa fa-cloud"></i></button>
            <button onclick="searchByKeyword('social')" class="bg-white text-bg-light btn btn-outline-warning"><i class="fa fa-people-group"></i></button>
            <button onclick="searchByKeyword('clean')" class="bg-white text-bg-light btn btn-outline-success"><i class="fa fa-leaf"></i></button>
            <button onclick="searchByKeyword('health')" class="bg-white text-bg-light btn btn-outline-danger"><i class="fa fa-star-of-life"></i></button>
        </div>
HTML;
}


$c1 = getProblemCard("HTG LLC",95,"€ 10,000 / project","Remote", "San Francisco, CA","Setup an infrastructure, using AWS.", "DevOps Outsource", "Cloud", "primary", "cloud");
$c2 = getProblemCard("EU",100,"€ 3,000 / member","---", "London, GB","Training, practical experience and career support.", "Law Conference", "Social", "warning", "people-group");
$c3 = getProblemCard("Jeez Trains",80,"€ 30,000 / project","Munich Arena", "Munich, Germany","Train Environment recognition Model using RL approach.", "ML Internship", "Clean Tech", "success", "leaf");
$c4 = getProblemCard("HTG LLC",90,"€ 300,000 / project","Munich Arena", "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Hackathon", "Health Tech", "danger", "star-of-life");$c3 = getProblemCard("Jeez Trains",80,"€ 30,000 / project","Munich Arena", "Munich, Germany","Train Environment recognition Model using RL approach.", "ML Internship", "Clean Tech", "success", "leaf");
$c5 = getProblemCard("G-Health LLC",70,"€ 300,000 / project","Munich Arena", "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Outsource", "Health Tech", "danger", "star-of-life");$c3 = getProblemCard("Jeez Trains",80,"€ 30,000 / project","Munich Arena", "Munich, Germany","Train Environment recognition Model using RL approach.", "ML Internship", "Clean Tech", "success", "leaf");
$c6 = getProblemCard("CNC LTD",75,"€ 300,000 / project","Munich Arena", "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Internship", "Health Tech", "danger", "star-of-life");
$c7 = getProblemCard("HTG LLC",95,"€ 10,000 / project","Remote", "San Francisco, CA","Setup an infrastructure, using AWS.", "DevOps Outsource", "Cloud", "primary", "cloud");
$c8 = getProblemCard("EU",100,"€ 3,000 / member","Some playground", "London, GB","Training, practical experience and career support.", "Law Conference", "Social", "warning", "people-group");
$body = <<<HTML

   $title

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
    
    function filterCards(value) {
        $(".problem").filter(function() {
          var hasValue = $(this).text().toLowerCase().indexOf(value) > -1;
          $(this).toggle(hasValue);
        });
    }
    
    $(document).ready(function(){
      setupCards();
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase().trim();
        filterCards(value);
        setupCards();
      });
    });
    
    function setupCards() {
        if ($user === 'coordinator') { filterCards('no place found') }
    }
    
    function searchByKeyword(keyword) {
        $(document).ready(function(){
            $("#myInput").val(keyword)
            filterCards(keyword);
            setupCards();
          });

    }
    </script>
    
    <div class="col  sticky-top p-2 mt-2 d-flex flex-wrap justify-content-center text-center">
        
        <input class="col-3 bg-white p-1 border-1 rounded-left text-center align-content-center" id="myInput" type="text" placeholder="Search..">
        <button onclick="searchByKeyword('')" class="bg-white btn-secondary text-bg-light border-1 rounded-right mr-2 align-middle"><i class="fa fa-times"></i></button>


        $filters
    </div>


   <div class="d-flex flex-wrap justify-content-center" id="myDIV">
        $c1
        $c2
        $c3
        $c4
        $c5
        $c6
        $c7
        $c8
   </div>
   
HTML;


echo page($navbar, $body);

?>