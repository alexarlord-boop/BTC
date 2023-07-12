<?php

session_start();
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/ui.php";
require "../utility.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    $userData = $db->where('id', $userId)->getOne('user');
    pre($userData);

    // update user data
    $userData['email'] = $_POST['email'];
    $userData['name'] = $_POST['name'];
    $userData['surname'] = $_POST['surname'];
    $userData['country'] = $_POST['country'];
    $userData['city'] = $_POST['city'];
    $userData['avatar_img'] = $_POST['avatar'];


    pre($userData);

    // update error handling (unified)
    $db->where('id', $userId);
    if ($db->update('user', $userData)) {
        echo $db->count . ' records were updated';
        $_SESSION['success'] = 'User info was updated!';

        // update for UI
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['fullName'] = $_POST['name'] . ' ' . $_POST['surname'];
        $_SESSION['avatar'] = $_POST['avatar'];

        redirect("../pages/settings.php");
    } else {
        echo 'update failed: ' . $db->getLastError();
        $_SESSION['error'] = 'Update error!';
        redirect("../pages/settings.php");
    }
}

?>