<?php
session_start();
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/ui.php";
require "../utility.php";

//$_SESSION['userType'] = null;
$_SESSION['title'] = '';
$_SESSION['lnk'] = '';

$label = getLabel();
$navbar = returnNavBar(null);
$title = pageTitle("", "Visitor dashboard");

$content = getUnderConstruction();


if ($GLOBALS['roleIdToName'][$_SESSION['currentRole']] !== 'visitor') {
    $body = <<<HTML
$title
            <p id="visitor-warning" class=" col-12 text-center mx-auto ">Change your role to see the content</p>
            <div id="visitor-dashboard" style="filter: blur(40px)"> 
                $content
            </div>
HTML;

} else {
    $body = <<<HTML
                
            $title
            <p id="visitor-warning" class=" col-12 text-center mx-auto ">Change your role to see the content</p>
            <script>$('#visitor-warning').fadeOut(0)</script>
            <div id="visitor-dashboard"> 
                $content
            </div>


HTML;

}



echo page($navbar, $body);

?>