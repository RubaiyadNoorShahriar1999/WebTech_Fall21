<?php

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit();
}

$has_err = false;
$success_msg = "";
$unsuccess_msg = "";

$currentpass = "";
$err_currentpass = "";

$newpass = "";
$err_newpass = "";

$retypepass = "";
$err_retypepass = "";

if (isset($_POST['changepassword'])) {

    require_once _ROOT_DIR . "models/User/UsersModel.php";

    $current_user = getUserByUsername($_SESSION['username']);

    if (!$current_user) {
        header("Location: login.php");
        exit();
    }

    // _var_dump($current_user);

    // Current Password
    if (empty($_POST['currentpass'])) {
        $err_currentpass = "Current Password can't be empty";
        $has_err = true;
    } else if ($_POST['currentpass'] != $current_user['u_password']) {
        $err_currentpass = "Current Password is not corrent";
        $has_err = true;
    } else {
        $currentpass = trim($_POST['currentpass']);
    }

    // New Password
    if (empty($_POST['newpass'])) {
        $err_newpass = "New Password can't be empty";
        $has_err = true;
    } else if (strlen(trim($_POST['newpass'])) <= 7) {
        $err_newpass = "New Password must be 8 characters or greater";
        $has_err = true;
    } else if (!preg_match("/[@#$%]+/", $_POST['newpass'])) {
        $err_newpass = "New Password must include special characters (@ # $ %)";
        $has_err = true;
    } else if ($_POST['newpass'] == $current_user['u_password']) {
        $err_newpass = "New Password must not be same as Current Password";
        $has_err = true;
    } else {
        $newpass = trim($_POST['newpass']);
    }

    // Retype Password
    if (empty($_POST['retypepass'])) {
        $err_retypepass = "Retype Password can't be empty";
        $has_err = true;
    } else if ($_POST['retypepass'] != $newpass) {
        $err_retypepass = "Retype Password must equal to New Password";
        $has_err = true;
    } else {
        $retypepass = trim($_POST['retypepass']);
    }

    // _var_dump($_SESSION);
    // exit;

    if (!$has_err) {

        // $update_user = getUserById($_SESSION['id']);
        // _var_dump($update_user);
        // exit();

        if ($current_user) {

            $is_updated = updatePassword($newpass, $current_user['u_id']);

            if ($is_updated) {

                $_SESSION['passwrod'] = $newpass;

                $success_msg = "Successfully Edited";
                $unsuccess_msg = "";
            } else {
                $success_msg = "";
                $unsuccess_msg = "No Change !!";
            }
        }
    }
}
