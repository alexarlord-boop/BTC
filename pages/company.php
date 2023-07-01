<?php

require_once "../components/dashboard_template.php";
require_once "../components/dash_card.php";

$_SESSION['searchFor'] = '';
$pointer = getPointers()['company'];

$card1 = getDashCard("Describe your values: what kind of a team you're looking for? Our system will find the best match for your expectations!",
"Search settings","primary", "search");

$card2 = getDashCard("Set up a real problem, provide technical tasks and choose reward.
                Publish your company's frustrations and find solutions by enthusiasts around the world,",
"Create Request", "primary", "question");

$card3 = getDashCard("  Keep track on your savings, efficiency of the chosen teams and problems solution.
                A nice tool for monitoring your Projects.", "Management", "primary", "balance-scale");

$content = <<<HTML
    <div class="row flex-wrap justify-content-center">
        $card1
        $card2
        $card3   
        <div class="m-2"></div>
    </div>


HTML;


echo returnDashboard("Company Dashboard", $pointer, $content)

?>