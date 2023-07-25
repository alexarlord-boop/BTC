<?php

session_start();

require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $id = $_POST['userId'];
    $infoId = $_POST['infoId'];
    $skills = $_POST['skills'];

    $data = $skills;

    $response = array('status' => 'success', 'message' => $skills);

    $memberInfo = $db->where('id', $infoId)->update('member_info', $data);



    if ($memberInfo) {
        $response = array('status' => 'success', 'message' => 'Member skills were updated!');
    } else {
        $response = array('status' => 'error', 'message' => json_decode($db->getLastError()));
    }



    echo json_encode($response);


}

?>