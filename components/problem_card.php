<?php
//
//include "../components/navbar.php";
//include "../components/head_template.php";

require "../utility.php";
session_start();


function getProblemCard($company, $percent, $fond, $platform, $place, $text, $event, $type, $color, $icon ) {
    $user = $_SESSION['userType'];
    if ($platform === null) {
        $platform = '<span class="text-danger font-weight-light">place is not set</span>';
    }




    return <<<HTML
        <div class="card problem rounded-4 col-12 col-lg-4 m-3" style="z-index: 0; max-width: 400px;" >
            <div class="card-body">
            <div class="card-title d-flex justify-content-between m-1 pb-4">
                <i class="fa fa-3x fa-{$icon} text-{$color} text-left"></i>
                <div class="justify-content-between flex-column d-flex">                
                    <p class="fs-6 text-secondary  text-right">$place</p>
                    <p class="fs-6 text-secondary  text-right">$platform</p>
                </div>
            </div>
            
            <div class="card-text h5">
                <p class="fs-6 text-primary text-right align-text-bottom">$type</p>
                <p class="fs-4 text-primary text-right align-text-bottom">$event</p>
                <p class="h6 fs-8 pb-4 font-weight-light text-primary text-right">by $company</p>
                <p class="text-primary"><span class="text-secondary">Fund:</span> $fond</p>
                <p class="text-primary"><span class="text-secondary">Compatibility:</span> $percent% </p>
                
                
                <div class="pt-3">$text</div>
                
            </div>
            </div>
            <div class="card-footer bg-transparent border-0"><a href="#" class="btn btn-outline-$color w-100 mt-4">Apply</a></div>
        </div>
HTML;

}

//$c1 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "primary", "star-of-life");
//$c2 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "success", "star-of-life");
//$c3 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "warning", "star-of-life");
//$c4 = getProblemCard("HTG LLC",95,"€ 300.000", "Munich Arena", "Munich, Germany", "Develop a web application for HealthTech consulting company.", "Hackathon", "Health Tech", "danger", "star-of-life");
//$body = <<<HTML
//    <div class="d-flex flex-wrap justify-content-center">
//
//        $c4
//</div>
//HTML;
//
//
//
//echo page("", $body)

?>