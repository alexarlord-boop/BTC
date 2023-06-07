<?php

session_start();
include "head_template.php";
include "navbar.php";
include "../utility.php";



function returnDashboard($title, $pointer, $content)
{
//    pre($pointer);

    $navbar = returnNavBar($pointer);
    $body = <<<HTML
           
           
           <h1 class="display-6 text-center p-3"><i class="fa fa-1x fa-laptop"></i> $title</h1>
           <div class="mt-3">
            $content
           </div>
HTML;

    return page($navbar, $body);
}

?>