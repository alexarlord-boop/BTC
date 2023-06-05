<?php

require_once "../components/dashboard_template.php";

$_SESSION['searchFor'] = '';
$pointer = getPointers()['company'];

$content = <<<HTML
    <div class="row flex-wrap justify-content-center">
        <div class="card col-md-3 col-sm-12 mx-2 my-2">
            <div class="card-body rounded">
            <div class="card-title"><i class="fa fa-3x fa-search text-primary text-center"></i></div>
            <div class="card-text">
                Describe your values: what kind of a team you're looking for? <br>
                <br>
                <br>
                Our system will find the best match for your expectations!
            </div>
            <a href="#" class="btn btn-primary mt-4">Search settings</a>
            </div>
        </div>
        <div class="card col-md-3 col-sm-12 mx-2 my-2">
            <div class="card-body rounded">
            <div class="card-title"><i class="fa fa-3x fa-question text-primary text-center"></i></div>
            <div class="card-text">
                Set up a real problem, provide technical tasks and choose reward.<br>
                Publish your company's frustrations and find solutions by enthusiasts around the world.
            </div>
            <a href="#" class="btn btn-primary mt-4">Create Request</a>
            </div>
        </div>
        <div class="card col-md-3 col-sm-12 mx-2 my-2">
            <div class="card-body rounded">
            <div class="card-title"><i class="fa fa-3x fa-balance-scale text-primary text-center"></i></div>
            <div class="card-text">
                Keep track on your savings, efficiency of the chosen teams and problems solution. <br>
                <br>
                <br>
                A nice tool for monitoring your Projects.
            </div>
            <a href="#" class="btn btn-primary mt-4">Management</a>
            </div>
        </div>
      
       
      
    </div>


HTML;


echo returnDashboard("Company Dashboard", $pointer, $content)

?>