<?php
include "../components/navbar.php";
include "../components/head_template.php";
require "../components/problem_card.php";



$navbar = returnNavBar(null);
$title = pageTitle("search", "Upcoming events");


$filters = <<<HTML
    <div class="bg-transparent p-1 rounded-5">
        <button name="filterBtn" onclick="searchByKeyword('cloud')" class="btn btn-outline-primary"><i class="fa fa-cloud"></i></button>
        <button name="filterBtn" onclick="searchByKeyword('social')" class="btn btn-outline-warning"><i class="fa fa-people-group"></i></button>
        <button name="filterBtn" onclick="searchByKeyword('clean')" class="btn btn-outline-success"><i class="fa fa-leaf"></i></button>
        <button name="filterBtn" onclick="searchByKeyword('health')" class="btn btn-outline-danger"><i class="fa fa-star-of-life"></i></button>
    </div>


    <script>
    <!--  filter btns logic -->
    </script>
HTML;



$c1 = getProblemCard("HTG LLC",95,"€ 10,000 / project","149 New Montgomery", "San Francisco, CA","Setup an infrastructure, using AWS.", "DevOps Outsource", "Cloud", "primary", "cloud");
$c2 = getProblemCard("EU",100,"€ 3,000 / member","Shoreditch, Montacute Yards", "London, GB","Training, practical experience and career support.", "Law Conference", "Social", "warning", "people-group");
$c3 = getProblemCard("Jeez Trains",80,"€ 30,000 / project","C", "Munich, Germany","Train Environment recognition Model using RL approach.", "ML Internship", "Clean Tech", "success", "leaf");
$c4 = getProblemCard("HTG LLC",90,"€ 300,000 / project","D", "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Hackathon", "Health Tech", "danger", "star-of-life");
$c5 = getProblemCard("G-Health LLC",70,"€ 300,000 / project",null, "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Outsource", "Health Tech", "danger", "star-of-life");
$c6 = getProblemCard("CNC LTD",75,"€ 300,000 / project",null, "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Internship", "Health Tech", "danger", "star-of-life");
$c7 = getProblemCard("HTG LLC",95,"€ 10,000 / project","Remote", "San Francisco, CA","Setup an infrastructure, using AWS.", "CI/CD", "Cloud", "primary", "cloud");
$c8 = getProblemCard("EU",100,"€ 3,000 / member",null, "London, GB","Training, practical experience and career support.", "Law Conference", "Social", "warning", "people-group");
$body = <<<HTML

   $title

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
        setupCards();
        filterCards(value);
      });
    }); 
    

    function searchByKeyword(keyword) {
        $(document).ready(function(){
            $("#myInput").val(keyword)
            filterCards(keyword);
            setupCards();
          });

    }
    </script>
    
    <div class="col sticky-top p-2 mt-2 d-flex flex-wrap justify-content-center text-center">
        
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