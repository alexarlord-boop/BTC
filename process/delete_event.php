<?php
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['eventId'];
    $companyId = $_POST['companyId'];


    $db->where('id', $id);
    $db->where('company_id', $companyId);


    if ($db->delete('event')) {
        $response = array('status' => 'success', 'message' => 'event deleted');
    } else {
        $response = array('status' => 'error', 'message' => $db->getLastError());
    }


    echo json_encode($response);
}
?>