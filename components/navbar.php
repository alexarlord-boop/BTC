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

        <nav class="col-md-12 navbar navbar-expand-lg navbar-light bg-light">
          <a class=" ml-3 navbar-brand badge-pill badge-primary text-light" href="../pages/login_page.php">B2Ts</a>
          
        
          
            <ul class="navbar-nav mr-auto">
              
              <a href="../pages/{$_SESSION['lnk']}" class="navbar-brand text-primary ml-5" style="cursor: pointer;">{$_SESSION['title']}</a>
            </ul>
            
            <a class="btn btn-light mr-2 border" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </a>

          
        </nav>



        




        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent">
            <li class="breadcrumb-item ml-4"><a href="../pages/login_page.php">main</a></li>
            <li class="breadcrumb-item"><a href="../pages/$user.php">$user</a></li>
            {$_SESSION['search_item']}
            
          </ol>
        </nav>
HTML;

}


?>