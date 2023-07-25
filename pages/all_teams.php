<?php
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/team_card.php";

include "../components/ui.php";
require "../utility.php";

$navbar = returnNavBar(null);
$title = pageTitle("search", "Teams");


/* TEAM DATA */

$teams = $db->get('team');


foreach ($teams as &$team) {

    /* Members data */
    /* join team_member + user_member + user + member_info  */
    $tm_tb = 'team_member';
    $um_tb = 'user_member';
    $mi_tb = 'member_info';
    $u_tb = 'user';


    $teamMembers = $db->where('team_id', $team['id'])->get('team_member');
    foreach ($teamMembers as &$member) {
        $db->where('id', $member['member_id']);
        $mem = $db->getOne('user_member');
        $mem_user = $db->where('id', $mem['user_id'])->getOne('user');
        $mem_info = $db->where('id', $mem['member_info_id'])->getOne('member_info');

        $member = array('user_info'=> $mem_user, 'member_info' => $mem_info);
    }

    /* Members data */

    $team = getTeam($team, $teamMembers);
}
$teams = join($teams);

/* TEAM DATA */


$filter = <<<HTML
<p class="my-3"></p>
<div class="col-12 text-center">

<input type="text" id="search" class="form-control col-2 d-inline-block" placeholder="Enter keywords">
<span id="clearIcon" class="me-5" style="cursor: pointer;">&#10006;</span>


<div class="d-inline-block col-2 btn border-2">
<label class="">Likes amount: <span id="likes" class="text-danger">1</span>+</label> <br>
<input type="range" id="likesRange" class="form-range  text-danger p-0 m-0" min="1" max="9" value="1">
</div>

<div class="d-inline-block col-2 btn border-2">
<label class="">Team Velocity: <span id="velocity" class="text-primary">10</span>+</label> <br>
<input type="range" id="velocityRange" class="form-range  p-0 m-0" min="10" max="99" value="10">
</div>

<button id="reset" class="btn btn-outline-dark">reset</button>
</div>
<p class="my-3"></p>

  <script>
    
    function filterCards(value) {
        
        
        $(".team").each(function() {
          var text = $(this).text();
          var hasAllKeywords = text.includes(value);
          $(this).toggle(hasAllKeywords);
        });

    }
    
    function filterByVelocity(velocity, likes) {
        $(".team").each(function() {
            
          var teamVelocity = $(this).find('.velocityValue').html();
          var teamlikes = $(this).find('.likesValue').html();
          var isGoodVelocity = (teamVelocity >= velocity);
          var hasBiggerLikes = (teamlikes >= likes);
          $(this).toggle(isGoodVelocity && hasBiggerLikes);
        });
    }
    
    function filterByLikes(velocity, likes) {
        $(".team").each(function() {
            
          var teamVelocity = $(this).find('.velocityValue').html();
          var teamlikes = $(this).find('.likesValue').html();
           var isGoodVelocity = (teamVelocity >= velocity);
          var hasBiggerLikes = (teamlikes >= likes);
          $(this).toggle(isGoodVelocity && hasBiggerLikes);
        });
    }
    
    $(document).ready(function(){
       var clearIcon = $("#clearIcon");
       let s =  $('#search');
       
       clearIcon.on("click", function() {
        s.val("");
        $('#business-field option[value=""]').attr("selected",true);
        $('#purpose option[value=""]').attr("selected",true);
        
        $(".team").show(); // Show all elements with class "problem" again
      });
       
       $('#reset').on('click', function () {
           $('#velocityRange').val(0);
           $('#likesRange').val(0);
           $('#velocity').html(10);
           $('#likes').html(1);
           $(".team").show(); 
       })
       
       $('#velocityRange').on('input', function () {
           $('#velocity').html($(this).val());
           filterByVelocity($(this).val(), $('#likesRange').val());
       })
       
       $('#likesRange').on('input', function () {
           $('#likes').html($(this).val());
           filterByLikes($('#velocityRange').val(), $(this).val());
       })
        
      
      
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
    
    $teams
    



    
   
   
HTML;


echo page($navbar, $body);

?>