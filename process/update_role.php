<?php
session_start();
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userId = $_POST['userId'];
    $roleId = $_POST['roleId'];
    $toSet = $_POST['toSet'];




    $data = array(
        'user_id' => $userId,
        'role_id' => $roleId
    );
    if ($toSet === "true") {

        $db->onDuplicate('IGNORE')->insert('user_role', $data);
        if ($db->getLastErrno() === 0) {
            $response = array('message' => 'success', 'data' => 'role added');
        } else {
            $response = array('message' => 'error', 'data' => $db->getLastError());
        }

    } else {

        $db->where('user_id', $userId);
        $db->where('role_id', $roleId);
        $result = $db->delete('user_role');

        if ($result) {
            $response = array('message' => 'success', 'data' => 'role removed');
        } else {
            $response = array('message' => 'error', 'data' => $db->getLastError());
        }
    }


    echo json_encode($response);
}
?>