<?php

require "../utility.php";

function getProblemCard($text, $btnTitle, $color, $icon ) {
    return <<<HTML
        <div class="card rounded-4 col-12 col-lg-4 m-5 mb-4" >
            <div class="card-body">
            <div class="card-title d-flex justify-content-between m-1 pb-4">
                <i class="fa fa-3x fa-{$icon} text-{$color} text-left "></i>
                <div class="justify-content-between flex-column d-flex">                
                    <p class="fs-6 text-secondary  text-right">Munich, Germany</p>
                    <p class="fs-6 text-secondary  text-right">Munich Arena</p>
                </div>
            </div>
            
            <div class="card-text h5">
                <p class="fs-4 pb-4 text-primary text-right align-text-bottom">HT Hackathon</p>
                <p class="text-primary"><span class="text-secondary">Prize fond:</span> € 300.000</p>
                <p class="text-primary"><span class="text-secondary">Win chance:</span> 95% </p>
                
                
                <div class="pt-3">$text</div>
                
            </div>
            </div>
            <div class="card-footer bg-transparent border-0"><a href="#" class="btn btn-outline-$color w-100 mt-4">$btnTitle</a></div>
        </div>
HTML;

}

//$c1 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "primary", "star-of-life");
//$c2 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "success", "star-of-life");
//$c3 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "warning", "star-of-life");
//$c4 = getProblemCard("Develop a web application for HealthTech consulting company.", "Apply", "danger", "star-of-life");
//$body = <<<HTML
//    <div class="d-flex flex-wrap justify-content-center">
//        $c1
//        $c2
//        $c3
//        $c4
//</div>
//HTML;
//
//
//
//echo page("", $body)

?>