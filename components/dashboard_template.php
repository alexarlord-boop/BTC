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
           
           <h5 class="text-center"><i class="fa fa-1x fa-laptop"></i> $title</h5>
           <div class="mt-3">
            $content
           </div>
HTML;

    return page($navbar, $body);
}

?>