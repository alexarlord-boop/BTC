<?php


function returnNavBar($pointer, $includeMenu=true) {




    if (!isset($_SESSION['userId'])) {
        $roleColor = '#000';
        $companySaves = '';
        $sideMenu = '';
        $signBtn = '<div class="col-4"><a href="../pages/signup.php" class="me-5">Sign up</a>'
        . '<a href="../pages/login.php" class="me-5">Log in</a></div>';


    } else {
        $roleColor = $_SESSION['color'];
        $sideMenu = '<a id="menuBtn" class="btn btn-light mr-3 border " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </a>';

        $companySaves = '';
        if ($GLOBALS['roleIdToName'][$_SESSION['currentRole']] == 'company') {
            $companySaves = '<div class="col-2 offset-6 rounded-circle border-warning border-5"><i class="fa fa-users"></i><p id="companySaves" class="d-inline badge-warning badge-pill">0</p></div>';
        }

        $color = $GLOBALS['roleIdToColorList'][$_SESSION['currentRole']];
        $signBtn = '';


    }





    return <<<HTML

        <nav class="col-md-12 sticky-top navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
          <a id="logo" class="navbar-brand ml-3 badge-pill text-light" href="../pages/main.php" style="background-color: {$roleColor}">BTC</a>
          
          
            $companySaves
            $signBtn
            <!-- Side menu / profile -->
            $sideMenu
            <!-- Side menu / profile END-->
            
        </nav>


HTML;

}


?>