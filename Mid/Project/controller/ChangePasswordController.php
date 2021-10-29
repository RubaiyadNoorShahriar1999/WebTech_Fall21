<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(dirname(__FILE__)) . "/helper/functions.php";

if (!_get_is_logged_in()) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['changepassword'])) {

    $has_err = false;
    $messages = [
        "errors" => [],
        "success" => [],
        "data" => []
    ];

    $currentpass = "";
    $newpass = "";
    $retypepass = "";


    // Current Password
    if (empty($_POST['currentpass'])) {
        $messages["errors"][] = "Current Password can't be empty";
        $has_err = true;
    } else if ($_POST['currentpass'] != _get_session_val("password")) {
        $messages["errors"][] = "Current Password is not corrent";
        $has_err = true;
    } else {
        $currentpass = trim($_POST['currentpass']);
    }

    // New Password
    if (empty($_POST['newpass'])) {
        $messages["errors"][] = "New Password can't be empty";
        $has_err = true;
    } else if (strlen(trim($_POST['newpass'])) <= 7) {
        $messages["errors"][] = "New Password must be 8 characters or greater";
        $has_err = true;
    } else if (!preg_match("/[@#$%]+/", $_POST['newpass'])) {
        $messages["errors"][] = "New Password must include special characters (@ # $ %)";
        $has_err = true;
    } else if ($_POST['newpass'] == $currentpass) {
        $messages["errors"][] = "New Password must not be same as Current Password";
        $has_err = true;
    } else {
        $newpass = trim($_POST['newpass']);
    }

    // Retype Password
    if (empty($_POST['retypepass'])) {
        $messages["errors"][] = "Retype Password can't be empty";
        $has_err = true;
    } else if ($_POST['retypepass'] != $newpass) {
        $messages["errors"][] = "Retype Password must equal to New Password";
        $has_err = true;
    } else {
        $retypepass = trim($_POST['retypepass']);
    }

    // _var_dump($_POST);
    // return;
    // _var_dump($messages);
    // return;

    // Store data in JSON
    if (!$has_err) {

        require_once _ROOT_DIR . "model/UserModel.php";

        if (_change_password(_get_session_val('email'), $newpass)) {

            // Send successful message
            $messages = [
                "errors" => [],
                "success" => [
                    "Successfully Changed"
                ],
                "data" => []
            ];
            _set_session_val("messages", $messages);
            header("Location: ../change-password.php");
        } else {
            $messages["errors"][] = "There is an error to change password";
            _set_session_val("messages", $messages);
            header("Location: ../change-password.php");
            exit();
        }
    } else {
        _set_session_val("messages", $messages);
        header("Location: ../change-password.php");
        exit();
    }
} else {
    header("Location: ../change-password.php");
    exit();
}
