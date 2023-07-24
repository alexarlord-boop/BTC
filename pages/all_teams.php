<?php
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/team_card.php";

include "../components/ui.php";
require "../utility.php";

$navbar = returnNavBar(null);
$title = pageTitle("search", "Teams");

//pre($_SESSION);
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

$body = <<<HTML
   
    $title
    
    $teams
    



    
   
   
HTML;


echo page($navbar, $body);

?>