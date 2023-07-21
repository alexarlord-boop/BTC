<?php
session_start();
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = array('test' => $_POST['values']);


    $eventId = $_POST['eventId'];
    $data = array(
        'date' => $_POST['values'][0],
        'description' => $_POST['values'][1],
        'duration' => $_POST['values'][2],
        'amount' => $_POST['values'][3]
    );

    $result = $db->where('id', $eventId)->update('event', $data);

    if ($result) {
        $response = array('status' => 'success', 'message' => 'event updated');
    } else {
        $response = array('status' => 'error', 'message' => $db->getLastError());
    }

//
//
//
//
//    $data = array(
//        'user_id' => $userId,
//        'role_id' => $roleId
//    );
//    if ($toSet === "true") {
//
//        $db->onDuplicate('IGNORE')->insert('user_role', $data);
//        if ($db->getLastErrno() === 0) {
//            $response = array('message' => 'success', 'data' => 'role added');
//        } else {
//            $response = array('message' => 'error', 'data' => $db->getLastError());
//        }
//
//    } else {
//
//        $db->where('user_id', $userId);
//        $db->where('role_id', $roleId);
//        $result = $db->delete('user_role');
//
//        if ($result) {
//            $response = array('message' => 'success', 'data' => 'role removed');
//        } else {
//            $response = array('message' => 'error', 'data' => $db->getLastError());
//        }
//    }


    echo json_encode($response);
}
?>