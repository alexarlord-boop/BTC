<?php
session_start();
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = array('test' => $_POST['values']);



    $data = array(
        'company_id' => $_POST['companyId'],
        'name' => 'default name',
        'business_field_id'=> 1,
        'purpose_id'=> 1,
        'place'=> 'default place',
        'reward' => 1000,
        'entrance_lvl' => 1,
        'cover_img' => 'https://media.giphy.com/media/1lALzcU4pUHWWMGTlK/giphy.gif?cid=ecf05e47315wow5kx0u34aji3j948e58zwnnj5w9unw08g4e&ep=v1_gifs_search&rid=giphy.gif&ct=g',
        'status_id'=> 1,
        'date' => $_POST['values'][0],
        'description' => $_POST['values'][1],
        'duration' => $_POST['values'][2],
        'amount' => $_POST['values'][3]
    );

    $result = $db->insert('event', $data);

    if ($result) {
        $response = array('status' => 'success', 'message' => 'event created');
    } else {
        $response = array('status' => 'error', 'message' => $db->getLastError());
    }


    echo json_encode($response);
}
?>