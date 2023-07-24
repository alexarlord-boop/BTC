<?php


function returnNavBar($pointer) {
    $roleColor = $_SESSION['color'];

    if ($pointer == null) {
        $_SESSION['title'] = '';
        $_SESSION['lnk'] = '';
    } else {
        $_SESSION['title']  = '<i class="fa fa-search"></i> ' . $pointer['title'];
        $_SESSION['lnk']  = $pointer['lnk'];
    }


    $companySaves = '';
    if ($GLOBALS['roleIdToName'][$_SESSION['currentRole']] == 'company') {
        $companySaves = '<div class=" rounded-circle border-warning border-5"><i class="fa fa-users"></i><p id="companySaves" class="d-inline badge-warning badge-pill">0</p></div>';
    }





    return <<<HTML

        <nav class="col-md-12 sticky-top navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
          <a id="logo" class="navbar-brand ml-3 badge-pill text-light" href="../pages/main.php" style="background-color: {$roleColor}">BTC</a>
          
            <div class="m-0 p-0">         
              <a href="../pages/{$_SESSION['lnk']}" class="navbar-brand text-primary" style="cursor: pointer;">{$_SESSION['title']}</a>
            </div>
            
            $companySaves
            <!-- Side menu / profile -->
            <a id="menuBtn" class="btn btn-light mr-3 border " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </a>
            <!-- Side menu / profile END-->
            
        </nav>


HTML;

}


?>