<?php
session_start();
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/event_card.php";
include "../components/newevent_card.php";
include "../components/ui.php";
require "../utility.php";

//$_SESSION['userType'] = null;
$_SESSION['title'] = '';
$_SESSION['lnk'] = '';

$label = getLabel();
$navbar = returnNavBar(null);
$title = pageTitle("", "Company dashboard");

$id = $_SESSION['userId'];
/* Company Data */
$companyInfoId = $db->where('user_id', $id)->getOne('user_company')['company_info_id'];
$company = $db->where('id', $companyInfoId)->getOne('company_info');
/* Company Data */

/* Events Data */
$events = $db->where('company_id', $company['id'])->get('event');
//pre($events);
foreach ($events as &$card) {
    $card = getProblemCard($card['id'], $company, 10, $card['reward'],$company['country']. '. ' . $company['city'], $card['place'],  $card['description'], $card['name'], 'type', 'primary', $card, true);
}
$events = join($events);
$newEvent = getNewEventCard($company);

/* Events Data */

$success = getSuccessInfo("",2000);
$error = getErrorInfo("", 2000);

//$content = getUnderConstruction();
$content = <<<HTML
<div class="d-flex flex-wrap justify-content-start align-items-start">

$events
$newEvent

</div>
HTML;



if ($GLOBALS['roleIdToName'][$_SESSION['currentRole']] !== 'company') {
    // Hiding content
    $body = <<<HTML

    $title
    $success
    $error
    
    <p id="company-warning" class=" col-12 text-center mx-auto ">Change your role to see the content</p>
    <div id="company-dashboard" style="filter: blur(10px); pointer-events: none;"> 
        $content
    </div>

HTML;

} else {
    // Showing content
    $body = <<<HTML
                
    $title
    $success
    $error
    
    <p id="company-warning" class=" col-12 text-center mx-auto ">Change your role to see the content</p>
    <script>$('#company-warning').fadeOut(0)</script>
    <div id="company-dashboard"> 
        $content
    </div>


HTML;

}



echo page($navbar, $body);

?>