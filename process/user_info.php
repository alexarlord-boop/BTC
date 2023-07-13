<?php

session_start();
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $db->where('id', $id);
        $userInfo = $db->getOne('user');

        $roleColor = setRoleColor();

        $response = array('message' => 'success', 'data' => $userInfo, 'role' => $_SESSION['currentRole'], 'color' => $roleColor);
        echo json_encode($response);
    }

}

?>