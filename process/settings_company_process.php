<?php

session_start();

require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $id = $_POST['userId'];
    $name = $_POST['name'];
    $country = $_POST['country'];
    $city = $_POST['city'];


    $companyInfoId = $db->where('user_id', $id)->getOne('user_company')['company_info_id'];

    if ($companyInfoId) {
        $data = array(
            'name' => $name,
            'country' => $country,
            'city' => $city
        );
        $db->where('id', $companyInfoId);
        if ($db->update('company_info', $data)) {
            $response = array('status' => 'success', 'message' => 'Company info was updated!');
        } else {
            $response = array('status' => 'error', 'message' => json_decode($db->getLastError()));
        }
        echo json_encode($response);
    }




}

?>