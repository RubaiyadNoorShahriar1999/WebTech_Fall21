<?php
// This will check if "actual user" request for new password
if (!isset($_SESSION['forget_pass']) || !isset($_SESSION['foget_pass_email'])) {
    header("Location: forget-password.php");
    exit();
}

$has_err = false;
$success_msg = "";
$unsuccess_msg = "";

$newpass = "";
$err_newpass = "";

$retypepass = "";
$err_retypepass = "";

if (isset($_POST['changeforgetpass'])) {

    require_once _ROOT_DIR . "models/User/UsersModel.php";

    $current_user = getUserByEmail($_SESSION['foget_pass_email']);

    // _var_dump($current_user);
    // exit();

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
        $err_newpass = "New Password must not be same as previous password";
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

    // Store data in JSON
    if (!$has_err) {

        $is_pass_changed = changeForgetPasswordUser($current_user['u_id'], $newpass);

        if ($is_pass_changed) {
            session_reset();
            session_unset();
            session_destroy();

            $success_msg = "Successfully Changed";
        } else {
            $unsuccess_msg = "unsuccessfully Changed";
        }
    }
}
