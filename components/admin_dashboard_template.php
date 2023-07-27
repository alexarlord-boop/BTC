<?php

session_start();
include "head_template.php";
include "navbar.php";
include "../utility.php";


function returnAdminDashboard($title, $pointer, $header)
{
    $navbar = returnNavBar($pointer);
    $title = pageTitle("laptop", $title);
    $body = <<<HTML
           $title
           <div class="mt-3">
           $header
           </div>
HTML;

    return page($navbar, $body);
}

?>