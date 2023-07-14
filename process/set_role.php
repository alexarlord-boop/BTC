<?php
session_start();
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentRoleId = $_POST['roleId'];
    $currentRoleName = $_POST['roleName'];
    $_SESSION['currentRole'] = $_POST['roleId'];

    //  role-based style
    $roleColor = setRoleColor();

    $roleName =  $GLOBALS['roleIdToName'][$_SESSION['currentRole']];

    $response = array('message' => 'success', 'data' => 'User role: ' . $currentRoleName, 'roleName'=>$roleName, 'color'=> $roleColor);
    echo json_encode($response);
}
?>