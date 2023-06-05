<?php
require_once "utility.php";

if (isset($_POST['type']) ) {
    $type = $_POST['type'];

    session_start();
    if ($type == '0') {
        $_SESSION['userType'] = 'company';
    } else if ($type == '1') {
        $_SESSION['userType'] = 'team';
    } else if ($type == '2') {
        $_SESSION['userType'] = 'coordinator';
    }
    header("location:pages/" . $_SESSION['userType'] . ".php");

}
?>