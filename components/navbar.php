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




    return <<<HTML

        <nav class="col-md-12 sticky-top navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
          <a id="logo" class="navbar-brand ml-3 badge-pill text-light" href="../pages/main.php" style="background-color: {$roleColor}">BTC</a>
          
            <div class="m-0 p-0">         
              <a href="../pages/{$_SESSION['lnk']}" class="navbar-brand text-primary" style="cursor: pointer;">{$_SESSION['title']}</a>
            </div>
            
            <!-- Side menu / profile -->
            <a id="menuBtn" class="btn btn-light mr-3 border " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </a>
            <!-- Side menu / profile END-->
            
        </nav>


HTML;

}


?>