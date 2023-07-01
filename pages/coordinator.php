<?php

require_once "../components/dashboard_template.php";
require_once "../components/dash_card.php";

$_SESSION['searchFor'] = '';
$pointer = getPointers()['coordinator'];

$card1 = getDashCard(" Describe what service or platform you can provide. Availability and capacity are important.
                Our system will find the best match for your expectations!", "Search settings", "warning", "search");

$content = <<<HTML
    <div class="row flex-wrap justify-content-center">
            
        $card1
        
        <div class="m-5"></div>
    </div>


HTML;


echo returnDashboard("Coordinator Dashboard", $pointer, $content)

?>