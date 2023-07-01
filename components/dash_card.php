<?php

function getDashCard($text, $btnTitle, $color, $icon ) {
    return <<<HTML
        <div class="card col-md-3 col-sm-12 mx-2 my-2" style="height: 350px;">
            <div class="card-body rounded">
            <div class="card-title"><i class="fa fa-3x fa-{$icon} text-{$color} text-center"></i></div>
            <div class="card-text h5">
                $text
            </div>
            </div>
            <div class="card-footer bg-transparent border-0"><a href="#" class="btn btn-{$color} mt-4">$btnTitle</a></div>
        </div>
HTML;

}

?>