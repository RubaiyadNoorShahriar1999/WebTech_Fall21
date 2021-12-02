<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: dashboard.php");
    exit();
}

$has_err = false;

$email = "";
$err_email = "";

if (isset($_POST['forget-pass'])) {
    // Email
    if (empty($_POST['email'])) {
        $err_email = "Email is required";
        $has_err = true;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $err_email = "Email is not valid";
        $has_err = true;
    } else {
        $email = validate_input($_POST['email']);
    }

    // _var_dump($_POST);
    // return;

    if (!$has_err) {
        require_once _ROOT_DIR . "models/User/UsersModel.php";

        $user = getUserByEmail($email);

        if ($user) {
            // This will prevent direcly change password by url
            $_SESSION['forget_pass'] = true;
            $_SESSION['foget_pass_email'] = $user['u_email'];

            // Redirect to add new password
            header("Location: change-forget-password.php");
        } else {
            $err_email = "Can not find the Email on Database";
            $has_err = true;
        }
    }
}
