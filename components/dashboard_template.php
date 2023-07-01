<?php

session_start();
include "head_template.php";
include "navbar.php";
include "../utility.php";



function returnDashboard($title, $pointer, $content)
{
//    pre($pointer);

    $navbar = returnNavBar($pointer);
    $title = pageTitle("laptop", $title);
    $body = <<<HTML
           
           
           $title
           <div class="mt-3">
            $content
           </div>
HTML;

    return page($navbar, $body);
}

?>