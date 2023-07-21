<?php
session_start();
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = array('test' => $_POST['values']);

    $id = $_POST['eventId'];
    $companyId = $_POST['companyId'];


     $db->where('id', $id);
     $db->where('company_id', $companyId);
     $result = $db->delete('event');

    if ($result) {
        $response = array('status' => 'success', 'message' => 'event deleted');
    } else {
        $response = array('status' => 'error', 'message' => $db->getLastError());
    }


    echo json_encode($response);
}
?>