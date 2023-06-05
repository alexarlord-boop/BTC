<?php

function pre($data) {
    print '<pre>' . print_r($data, true) . '</pre>';
}

function page($navbar, $body) {
    return <<<HTML
            <!doctype html>
            <html lang="en">
            
            
            <body>
            $navbar
                
            <div class="container mt-3 h-100">
                $body
            </div>
            
            <div class="container">
              <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                  <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
                  </a>
                  <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Company, Inc</span>
                </div>
            
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                  <li class="ms-3"><a class="text-body-secondary" href="#"><i class="fa-brands fa-2x fa-github"></i></a></li>
                  <li class="ms-3"><a class="text-body-secondary" href="#"><i class="fa-brands fa-2x fa-linkedin"></i></a></li>
                </ul>
              </footer>
            </div>
            
            
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasWithBothOptionsLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdrop with scrolling</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <p>Try scrolling the rest of the page to see this option in action.</p>
              </div>
            </div>              
              
              
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
            </body>
            </html>
HTML;

}

function getPointers()
{

    return array(
        'team' => array(
            'title' => "Companies",
            'lnk' => "all_companies.php",
            'dash' => 'team.php'
        ),
        'company' => array(
            'title' => "Teams",
            'lnk' => "all_teams.php",
            'dash' => 'company.php'
        )
    );

}

?>