<?php

require_once "../components/dashboard_template.php";

$_SESSION['searchFor'] = '';
$pointer = getPointers()['coordinator'];

$content = <<<HTML
    <div class="row flex-wrap justify-content-center">
        <div class="card col-md-3 col-sm-12 mx-2 my-2">
            <div class="card-body rounded">
            <div class="card-title"><i class="fa fa-3x fa-search text-warning text-center"></i></div>
            <div class="card-text">
                Describe what service or platform you can provide. Availability and capacity are important.<br>
                <br>
                Our system will find the best match for your expectations!
            </div>
            <a href="#" class="btn btn-warning mt-4">Search settings</a>
            </div>
        </div>
     
        <div class="card col-md-3 col-sm-12 mx-2 my-2">
            <div class="card-body rounded">
            <div class="card-title"><i class="fa fa-3x fa-balance-scale text-warning text-center"></i></div>
            <div class="card-text">
                Keep track on your savings, efficiency of the chosen teams and problems solution. <br>
                <br>
                <br>
                A nice tool for monitoring your Projects.
            </div>
            <a href="#" class="btn btn-warning mt-4">Management</a>
            </div>
        </div>
        <div class="m-5"></div>
    </div>


HTML;


echo returnDashboard("Coordinator Dashboard", $pointer, $content)

?>