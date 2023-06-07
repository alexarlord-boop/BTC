<?php


function returnNavBar($pointer) {

    if ($pointer == null) {
        $_SESSION['title'] = '';
        $_SESSION['lnk'] = '';
    } else {
        $_SESSION['title']  = '<i class="fa fa-search"></i> ' . $pointer['title'];
        $_SESSION['lnk']  = $pointer['lnk'];
    }



    $user = $_SESSION["userType"];
    $_SESSION['search_item'] = '';
    if ($_SESSION['searchFor'] != '') {
        $lnk = getPointers()[$_SESSION['userType']]['lnk'];

        $_SESSION['search_item'] = <<<HTML
            <li class="breadcrumb-item"><a href="../pages/$lnk">search</a></li>
HTML;

    }

    return <<<HTML

        <nav class="col-md-12 sticky-top navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
          <a class="navbar-brand ml-3 badge-pill badge-primary text-light" href="../pages/login_page.php">BTC</a>
          
            <div class="m-0 p-0">         
              <a href="../pages/{$_SESSION['lnk']}" class="navbar-brand text-primary" style="cursor: pointer;">{$_SESSION['title']}</a>
            </div>
            
            <a class="btn btn-light mr-3 border " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </a>
            
        </nav>

        <nav aria-label="breadcrumb " style="margin-top: 0px; position: fixed; z-index: 1000;">
          <ol class="breadcrumb bg-white p-2 rounded-5">
            <li class="breadcrumb-item ml-4"><a href="../pages/login_page.php">main</a></li>
            <li class="breadcrumb-item"><a href="../pages/$user.php">$user</a></li>
            {$_SESSION['search_item']}
            
          </ol>
        </nav>
HTML;

}


?>