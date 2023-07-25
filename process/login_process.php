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
    if ($user) {
        // Verify the password using password_hash()
        if (password_verify($user_password, trim($user['password']))) {
//        if ($user_password === trim($user['password'])) {
            // Login successful
            $userId = $user['id'];
            $db->where('user_id', $userId);
            $userRoles = $db->get('user_role');
            $roleIds = getRoleIds($userRoles);

            session_start();
            $_SESSION['userId'] = $userId;
            $_SESSION['email'] = $email;
            $_SESSION['fullName'] = $user['name'] . ' ' . $user['surname'];
            $_SESSION['roles'] = $roleIds;
            $_SESSION['avatar'] = $user['avatar_img'];

            $_SESSION['currentRole'] = strval($roleIds[0]); // should be global, for role-base data
            setRoleColor();

            $id = $_SESSION['userId'];
            $db->where('user_id', $id);
            $userRoles = $db->get('user_role');
            $roleIds = getRoleIds($userRoles);
            $_SESSION['roles'] = $roleIds;
            $_SESSION['roleSwitch'] = getRoleSwitch($roleIds);

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