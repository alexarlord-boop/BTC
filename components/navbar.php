<?php


function returnNavBar($pointer, $includeMenu=true) {




    if (!isset($_SESSION['userId'])) {
        $roleColor = '#000';
        $companySaves = '';
        $sideMenu = '';
        $signBtn = '<div class="col-4"><a href="../pages/signup.php" class="me-5">Sign in</a>'
        . '<a href="../pages/login.php" class="me-5">Log in</a></div>';


    } else {
        $roleColor = $_SESSION['color'];
        $sideMenu = '<a id="menuBtn" class="btn btn-light mr-3 border " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </a>';

        $companySaves = '';
        if ($GLOBALS['roleIdToName'][$_SESSION['currentRole']] == 'company') {
            $companySaves = '<div class=" rounded-circle border-warning border-5"><i class="fa fa-users"></i><p id="companySaves" class="d-inline badge-warning badge-pill">0</p></div>';
        }

        $color = $GLOBALS['roleIdToColorList'][$_SESSION['currentRole']];
        $signBtn = ($_SESSION['currentRole'] === '4') ? '<a href="../pages/signup.php" style="color: '. $color .'">Sign in</a>' : '';


    }





    return <<<HTML

        <nav class="col-md-12 sticky-top navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
          <a id="logo" class="navbar-brand ml-3 badge-pill text-light" href="../pages/main.php" style="background-color: {$roleColor}">BTC</a>
          
            <div class="m-0 p-0">         
              <a href="../pages/{$_SESSION['lnk']}" class="navbar-brand text-primary" style="cursor: pointer;">{$_SESSION['title']}</a>
            </div>
            
            $companySaves
            $signBtn
            <!-- Side menu / profile -->
            $sideMenu
            <!-- Side menu / profile END-->
            
        </nav>


HTML;

}


?>