<?php
include "../components/navbar.php";
include "../components/head_template.php";
require "../utility.php";
session_start();
$_SESSION['searchFor'] = $_SESSION['userType'];
$navbar = returnNavBar(null);
$body = <<<HTML
   
    <div class="display-4"><i class="fa  fa-search"></i> Search for the Best Team</div>
    
    <table class="table align-middle mt-5 mb-0 bg-white">
        <thead class="bg-light">
            <tr>
              <th class="h3">Team A</th>
              <th>Title</th>
              <th>Status</th>
              <th>Position</th>
              <th>Actions</th>
            </tr>
          </thead>
        <tbody >
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img
                      src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                      alt=""
                      style="width: 45px; height: 45px"
                      class="rounded-circle"
                      />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">John Doe</p>
                    <p class="text-muted mb-0">john.doe@gmail.com</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1">Software engineer</p>
                <p class="text-muted mb-0">IT department</p>
              </td>
              <td  class="align-middle">
                <span class="badge badge-success rounded-pill d-inline ">Active</span>
              </td>
              <td  class="align-middle">Senior</td>
              <td>
                <button type="button" class="btn btn-link btn-sm btn-rounded">
                  Edit
                </button>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img
                      src="https://mdbootstrap.com/img/new/avatars/6.jpg"
                      class="rounded-circle"
                      alt=""
                      style="width: 45px; height: 45px"
                      />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">Alex Ray</p>
                    <p class="text-muted mb-0">alex.ray@gmail.com</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1">Consultant</p>
                <p class="text-muted mb-0">Finance</p>
              </td>
              <td  class="align-middle">
                <span class="badge badge-primary rounded-pill d-inline"
                      >Onboarding</span
                  >
              </td>
              <td  class="align-middle">Junior</td>
              <td>
                <button
                        type="button"
                        class="btn btn-link btn-rounded btn-sm fw-bold"
                        data-mdb-ripple-color="dark"
                        >
                  Edit
                </button>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img
                      src="https://mdbootstrap.com/img/new/avatars/7.jpg"
                      class="rounded-circle"
                      alt=""
                      style="width: 45px; height: 45px"
                      />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">Kate Hunington</p>
                    <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1">Designer</p>
                <p class="text-muted mb-0">UI/UX</p>
              </td>
              <td  class="align-middle">
                <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
              </td>
              <td  class="align-middle">Senior</td>
              <td>
                <button
                        type="button"
                        class="btn btn-link btn-rounded btn-sm fw-bold"
                        data-mdb-ripple-color="dark"
                        >
                  Edit
                </button>
              </td>
            </tr>
          </tbody>
    </table>
    
    <table class="table align-middle mt-5 mb-0 bg-white">
        <thead class="bg-light">
            <tr>
              <th class="h3">Team B</th>
              <th>Title</th>
              <th>Status</th>
              <th>Position</th>
              <th>Actions</th>
            </tr>
          </thead>
        <tbody >
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img
                      src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                      alt=""
                      style="width: 45px; height: 45px"
                      class="rounded-circle"
                      />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">John Doe</p>
                    <p class="text-muted mb-0">john.doe@gmail.com</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1">Software engineer</p>
                <p class="text-muted mb-0">IT department</p>
              </td>
              <td  class="align-middle">
                <span class="badge badge-success rounded-pill d-inline ">Active</span>
              </td>
              <td  class="align-middle">Senior</td>
              <td>
                <button type="button" class="btn btn-link btn-sm btn-rounded">
                  Edit
                </button>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img
                      src="https://mdbootstrap.com/img/new/avatars/6.jpg"
                      class="rounded-circle"
                      alt=""
                      style="width: 45px; height: 45px"
                      />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">Alex Ray</p>
                    <p class="text-muted mb-0">alex.ray@gmail.com</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1">Consultant</p>
                <p class="text-muted mb-0">Finance</p>
              </td>
              <td  class="align-middle">
                <span class="badge badge-primary rounded-pill d-inline"
                      >Onboarding</span
                  >
              </td>
              <td  class="align-middle">Junior</td>
              <td>
                <button
                        type="button"
                        class="btn btn-link btn-rounded btn-sm fw-bold"
                        data-mdb-ripple-color="dark"
                        >
                  Edit
                </button>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img
                      src="https://mdbootstrap.com/img/new/avatars/7.jpg"
                      class="rounded-circle"
                      alt=""
                      style="width: 45px; height: 45px"
                      />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">Kate Hunington</p>
                    <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1">Designer</p>
                <p class="text-muted mb-0">UI/UX</p>
              </td>
              <td  class="align-middle">
                <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
              </td>
              <td  class="align-middle">Senior</td>
              <td>
                <button
                        type="button"
                        class="btn btn-link btn-rounded btn-sm fw-bold"
                        data-mdb-ripple-color="dark"
                        >
                  Edit
                </button>
              </td>
            </tr>
          </tbody>
    </table>
    
    <table class="table align-middle mt-5 mb-0 bg-white">
        <thead class="bg-light">
            <tr>
              <th class="h3">Team C</th>
              <th>Title</th>
              <th>Status</th>
              <th>Position</th>
              <th>Actions</th>
            </tr>
          </thead>
        <tbody >
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img
                      src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                      alt=""
                      style="width: 45px; height: 45px"
                      class="rounded-circle"
                      />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">John Doe</p>
                    <p class="text-muted mb-0">john.doe@gmail.com</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1">Software engineer</p>
                <p class="text-muted mb-0">IT department</p>
              </td>
              <td  class="align-middle">
                <span class="badge badge-success rounded-pill d-inline ">Active</span>
              </td>
              <td  class="align-middle">Senior</td>
              <td>
                <button type="button" class="btn btn-link btn-sm btn-rounded">
                  Edit
                </button>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img
                      src="https://mdbootstrap.com/img/new/avatars/6.jpg"
                      class="rounded-circle"
                      alt=""
                      style="width: 45px; height: 45px"
                      />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">Alex Ray</p>
                    <p class="text-muted mb-0">alex.ray@gmail.com</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1">Consultant</p>
                <p class="text-muted mb-0">Finance</p>
              </td>
              <td  class="align-middle">
                <span class="badge badge-primary rounded-pill d-inline"
                      >Onboarding</span
                  >
              </td>
              <td  class="align-middle">Junior</td>
              <td>
                <button
                        type="button"
                        class="btn btn-link btn-rounded btn-sm fw-bold"
                        data-mdb-ripple-color="dark"
                        >
                  Edit
                </button>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img
                      src="https://mdbootstrap.com/img/new/avatars/7.jpg"
                      class="rounded-circle"
                      alt=""
                      style="width: 45px; height: 45px"
                      />
                  <div class="ms-3">
                    <p class="fw-bold mb-1">Kate Hunington</p>
                    <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1">Designer</p>
                <p class="text-muted mb-0">UI/UX</p>
              </td>
              <td  class="align-middle">
                <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
              </td>
              <td  class="align-middle">Senior</td>
              <td>
                <button
                        type="button"
                        class="btn btn-link btn-rounded btn-sm fw-bold"
                        data-mdb-ripple-color="dark"
                        >
                  Edit
                </button>
              </td>
            </tr>
          </tbody>
    </table>
   
HTML;


echo page($navbar, $body);

?>