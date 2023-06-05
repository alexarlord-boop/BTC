<?php

require_once "../components/dashboard_template.php";

$_SESSION['searchFor'] = '';
$pointer = getPointers()['team'];

$content = <<<HTML
    <div class="row flex-wrap justify-content-center">
        <div class="card col-md-3 col-sm-12 mx-2 my-2">
            <div class="card-body rounded">
            <div class="card-title"><i class="fa fa-3x fa-search text-success text-center"></i></div>
            <div class="card-text">
                Find realistic problems to solve or interesting events to visit. <br>
                <br>
                Describe your team from different perspectives.
                Our system will find the best match for your expectations!
            </div>
            <a href="#" class="btn btn-success mt-4">Search settings</a>
            </div>
        </div>
        
        <div class="card col-md-3 col-sm-12 mx-2 my-2">
            <div class="card-body rounded">
            <div class="card-title"><i class="fa fa-3x fa-balance-scale text-success text-center"></i></div>
            <div class="card-text">
                Keep track on your performance and impact. <br>
                <br>
                <br>
                    
                Analyse your team activity, keep in touch with facilitators and companies.
               
            </div>
            <a href="#" class="btn btn-success mt-4">Management</a>
            </div>
        </div>
        <div class="m-5"></div>
    </div>


HTML;

echo returnDashboard("Team Dashboard", $pointer, $content);


?>