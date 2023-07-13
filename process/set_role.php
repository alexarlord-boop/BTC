<?php
session_start();
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentRoleId = $_POST['roleId'];
    $currentRoleName = $_POST['roleName'];
    $_SESSION['currentRole'] = $_POST['roleId'];

    //  role-based style
    $roleColor = setRoleColor();


    $response = array('message' => 'success', 'data' => 'User role: ' . $currentRoleName, 'color'=> $roleColor);
    echo json_encode($response);
}
?>