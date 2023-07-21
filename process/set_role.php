<?php
session_start();
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentRoleId = $_POST['roleId'];
    $currentRoleName = $_POST['roleName'];
    $_SESSION['currentRole'] = $_POST['roleId'];

    //  role-based style
    $roleColor = setRoleColor();

    $id = $_SESSION['userId'];
    $db->where('user_id', $id);
    $userRoles = $db->get('user_role');
    $roleIds = getRoleIds($userRoles);
    $_SESSION['roles'] = $roleIds;
    $_SESSION['roleSwitch'] = getRoleSwitch($roleIds);

    $roleName =  $GLOBALS['roleIdToName'][$_SESSION['currentRole']];

    $response = array('message' => 'success', 'data' => 'User role: ' . $currentRoleName, 'roleName'=>$roleName, 'switch'=>$_SESSION['roleSwitch'], 'color'=> $roleColor);
    echo json_encode($response);
}
?>