<?php

require_once "../components/dashboard_template.php";
require_once "../components/dash_card.php";

$_SESSION['searchFor'] = '';
$pointer = getPointers()['team'];

$card1 = getDashCard("  Find realistic problems to solve or interesting events to visit.
                Our system will find the best match for your expectations!",
"Search settings","success", "search");

$card2 = getDashCard(" Keep track on your performance and impact.
                Analyse your team activity, keep in touch with facilitators and companies.",
"Management", "success", "balance-scale");

$content = <<<HTML
    <div class="row flex-wrap justify-content-center">
        $card1
        $card2
        
        <div class="m-5"></div>
    </div>


HTML;

echo returnDashboard("Team Dashboard", $pointer, $content);


?>