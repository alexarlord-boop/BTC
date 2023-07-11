<?php
include "../components/head_template.php";
include "../components/navbar.php";
include "../components/ui.php";
require "../utility.php";


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    pre($_POST);

    // Retrieve the form data from $_POST
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $avatar = $_POST['avatar'];
    $role = $_POST['option'];




    // Check if the email already exists in the database
    $db->where('email', $email);
    $existingUser = $db->getOne('user');

    if ($existingUser) {
        // User with the same email already exists
        echo "User with the same email already exists.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the data to be inserted into the database
        $path_avatar = '/img/' . 'avatar.jpeg'; // later image blob storage

        $user_data = [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'password' => $hashedPassword,
            'avatar_img' => $path_avatar
            // Add other columns as needed

        ];

        $db->startTransaction();

        // Insert the data into the "users" table
        $userId = $db->insert('user', $user_data);
        if ($userId) {
            $user_role_data = [
                'user_id' => $userId,
                'role_id' => ($role === 'company') ? 1 : 2 // more roles -> more cases. indexing from 1
            ];
            $user_role_id = $db->insert('user_role', $user_role_data);

            if ($userId && $user_role_id) {
                // Registration successful
                $db->commit();

                session_start();
                $_SESSION['userId'] = $userId;
                $_SESSION['email'] = $email;
                $_SESSION['fullName'] = $name . ' ' . $surname;
                $_SESSION['roles'] = [$user_role_data['role_id']];

                echo "Registration successful!";
                redirect("../pages/main.php");

            } else {
                // Registration failed
                echo "Registration failed.";
                $db->rollback();
            }
        }
    }
}
?>
