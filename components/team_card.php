<?php

function getTeam($team, $members) {
    /* company -> contact (save) */
    /* member -> edit (update) specific team */

    $usersTeam = false;
    $actionBtn = '';
    if ($GLOBALS['roleIdToName'][$_SESSION['currentRole']] == 'company') {

        $actionBtn = <<<HTML
    <button onclick="add()" class="btn mx-1 btn-outline-dark border-2">Save</button>
<script>
function add() {
    
    $('#companySaves').html(1);
}
</script>
HTML;

    }

    foreach ($members as $member) {
        if ($_SESSION['userId'] === $member['user_info']['id']) {
            $actionBtn = '<span class="btn mx-1 btn-outline-dark border-2">Edit</span>';
            $usersTeam = true;
            break;
        }
    }

    $extra = '';
    if ($usersTeam) {
        $extra = '<div class="col-md-6 text-primary fs-5 offset-md-3">my team</div>';
    }

//    if ($GLOBALS['roleIdToName'][$_SESSION['currentRole']] == 'member') {
//        if ($_SESSION['user_id'] )
//    }




    $status = $team['is_open'] ? '<span title="status" class="btn mx-1 border-success rounded-5 border-2"><i class="far fa-compass"></i> Open to work</span>' :
        '<span title="status" class="btn mx-1 border-warning rounded-5 border-2"><i class="far fa-sign"></i> Busy</span>';



    $memberData = '';

    foreach ($members as $member) {

        $memberData .=
            <<<HTML
<tr>
          <td>
            <div class="d-flex align-items-center">
              <img
                  src="{$member['user_info']['avatar_img']}"
                  alt=""
                  style="width: 45px; height: 45px"
                  class="rounded-circle"
                  />
              <div class="ms-3">
                <p class="fw-bold mb-1">{$member['user_info']['name']} {$member['user_info']['surname']}</p>
                <p class="text-muted mb-0">{$member['user_info']['email']}</p>
              </div>
            </div>
          </td>
          <td><p></p></td>
          <td>
            <p class="fw-normal text-center mb-1">{$member['member_info']['backend']}</p>
          </td>
          <td>
            <p class="fw-normal text-center mb-1">{$member['member_info']['frontend']}</p>
          </td>
          <td>
            <p class="fw-normal text-center mb-1">{$member['member_info']['analytics']}</p>
          </td>
          <td>
            <p class="fw-normal text-center mb-1">{$member['member_info']['management']}</p>
          </td>
          <td>
            <p class="fw-normal text-center mb-1">{$member['member_info']['design']}</p>
          </td>
          <td>
            <p class="fw-normal text-center mb-1">{$member['member_info']['db']}</p>
          </td>
          
          
          
        </tr>
        
HTML;

    }





    return <<<HTML

$extra
<div class="card col-md-8 mb-5 p-3 offset-md-2 rounded-5">
<div class="row">
<div class="card-title col-6 d-flex justify-content-start text-center my-2">
<span title="likes" class="btn mx-1 border-danger rounded-5 border-2"><i class="far fa-heart"></i> {$team['likes']}</span>
<!--<span title="completed projects" class="btn mx-1 border-primary rounded-5 border-2"><i class="fa fa-hammer"></i> &#45;&#45;</span>-->
<span title="velocity" class="btn mx-1 border-primary rounded-5 border-2"><i class="fa fa-percent"></i>{$team['velocity']}</span>
$status

</div>
</div>

<style>

tbody {
    display: block;
    max-height: 200px;
    overflow: auto;
}
thead, tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;/* even columns width , fix width of table too*/
}

table {
    width: 400px;
}
</style>
<table class="table align-middle my-3 bg-white"  >
    <thead class="bg-light text-center">
        <tr>
          <th class="h3">{$team['name']}</th>
          <th class="h3"></th>
          <th>backend</th>
          <th>frontend</th>
          <th>analytics</th>
          <th>PM</th>
          <th>design</th>
          <th>db</th>
        </tr>
      </thead>
    <tbody>
        
        $memberData
        
      </tbody>
</table>

    
    
    
    
    
<div class="row">
<div class="col-6 offset-6  d-flex justify-content-center text-center mt-2">

$actionBtn
</div>
</div>
</div>
HTML;

}

?>