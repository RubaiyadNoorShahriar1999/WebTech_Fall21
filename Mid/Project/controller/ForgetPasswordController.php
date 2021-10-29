<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(dirname(__FILE__)) . "/helper/functions.php";

// If user logged in redirect to Change password page
if (_get_is_logged_in()) {
    header("Location: ../change-password.php");
    exit();
}

if (isset($_POST['forgetpass'])) {

    $has_err = false;
    $messages = [
        "errors" => [],
        "success" => [],
        "data" => []
    ];

    $email = "";

    // Email
    if (empty($_POST['email'])) {
        $messages["errors"][] = "Email is required";
        $has_err = true;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $messages["errors"][] = "Email is not valid";
        $has_err = true;
    } else {
        $email = validate_input($_POST['email']);
    }

    // _var_dump($_POST);
    // return;
    // _var_dump($messages);
    // return;

    // Store data in JSON
    if (!$has_err) {

        require_once _ROOT_DIR . "model/UserModel.php";

        if (_verify_forget_password($messages, $email)) {

            // Send successful message
            $messages = [
                "errors" => [],
                "success" => [],
                "data" => []
            ];

            _set_session_val("messages", $messages);

            // Redirect to add new password
            header("Location: ../change-forget-password.php");
        } else {
            _set_session_val("messages", $messages);
            header("Location: ../forget-password.php");
            exit();
        }
    } else {
        _set_session_val("messages", $messages);
        header("Location: ../forget-password.php");
        exit();
    }
} else {
    header("Location: ../forget-password.php");
    exit();
}
