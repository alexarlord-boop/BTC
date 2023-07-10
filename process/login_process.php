<?php

include "../components/head_template.php";
include "../components/navbar.php";
include "../components/ui.php";
require "../utility.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email and password from $_POST
    $email = $_POST['email'];
    $user_password = $_POST['password'];


    // Prepare and execute a SQL query to check if the email and password match
    // Check if the email exists in the database
    $db->where('email', $email);
    $user = $db->getOne('user');
//    pre($user['password']);
//    pre($user_password);
    if ($user) {
        // Verify the password using password_hash()
//        if (password_verify($user_password, trim($user['password']))) {
        if ($user_password === trim($user['password'])) {
            // Login successful
            session_start();
            $_SESSION['email'] = $email;
            echo "Login successful. Welcome, $email!";
            redirect("../pages/main.php");
        } else {
            // Login failed
            echo "Login failed. Invalid email or password.\n";
            echo "Password not verified.";
        }
    } else {
        // Login failed
        echo "Login failed. Invalid email or password.\n";
        echo "No user found.";
    }

}


?>