<?php


function returnNavBar($pointer) {

    if ($pointer == null) {
        $_SESSION['title'] = '';
        $_SESSION['lnk'] = '';
    } else {
        $_SESSION['title']  = '<i class="fa fa-search"></i> ' . $pointer['title'];
        $_SESSION['lnk']  = $pointer['lnk'];
    }



//    $user = $_SESSION["userType"];
//    $user = "";
//    $_SESSION['search_item'] = '';
//    if ($_SESSION['searchFor'] != '') {
//        $lnk = getPointers()[$_SESSION['userType']]['lnk'];
//
//        $_SESSION['search_item'] = <<<HTML
//            <li class="breadcrumb-item"><a href="../pages/$lnk">search</a></li>
//HTML;
//
//    }

    return <<<HTML

        <nav class="col-md-12 sticky-top navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
          <a class="navbar-brand ml-3 badge-pill badge-primary text-light" href="../pages/main.php">BTC</a>
          
            <div class="m-0 p-0">         
              <a href="../pages/{$_SESSION['lnk']}" class="navbar-brand text-primary" style="cursor: pointer;">{$_SESSION['title']}</a>
            </div>
            
            <a class="btn btn-light mr-3 border " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </a>
            
        </nav>


HTML;

}


?>