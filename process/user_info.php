<?php

session_start();
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $db->where('id', $id);
        $userInfo = $db->getOne('user');

        $roleColor = setRoleColor();

        $db->where('user_id', $id);
        $userRoles = $db->get('user_role');
        $roleIds = getRoleIds($userRoles);
        $_SESSION['roles'] = $roleIds;
        $_SESSION['roleSwitch'] = getRoleSwitch($roleIds);

        $response = array('message' => 'success', 'data' => $userInfo, 'role' => $_SESSION['currentRole'], 'switch'=>$_SESSION['roleSwitch'], 'color' => $roleColor);
        echo json_encode($response);
    }

}

?>