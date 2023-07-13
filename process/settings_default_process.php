<?php

session_start();

require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    $userData = $db->where('id', $userId)->getOne('user');


    // update user data
    $userData['email'] = $_POST['email'];
    $userData['name'] = $_POST['name'];
    $userData['surname'] = $_POST['surname'];
    $userData['country'] = $_POST['country'];
    $userData['city'] = $_POST['city'];
    $userData['avatar_img'] = $_POST['avatar'];



    // update error handling (unified)
    $db->where('id', $userId);
    if ($db->update('user', $userData)) {

        // update for UI
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['fullName'] = $_POST['name'] . ' ' . $_POST['surname'];
        $_SESSION['avatar'] = $_POST['avatar'];

        $response = array('message' => 'success', 'data' => 'User info was updated!');
        echo json_encode($response);
    } else {
        $response = array('message' => 'error', 'data' => json_decode($db->getLastError()));
        echo json_encode($response);

    }
}

?>