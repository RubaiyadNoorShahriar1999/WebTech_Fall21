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

if (_get_session_val('utype') != "admin") {
    header("Location: ../dashboard.php");
    exit();
}

if (isset($_POST['viewusers'])) {
    // _var_dump($_POST);
    // return;

    $has_err = false;
    $messages = [
        "errors" => [],
        "success" => [],
        "data" => []
    ];

    $name = "";
    $email = "";

    // Name
    if (!empty($_POST['name']) && preg_match("/^[a-zA-Z-.]/", $_POST['name']) != 1) {
        $messages["errors"][] = "Name must be contains alpha character, (.) and (-)";
        $has_err = true;
    } else {
        $name = validate_input($_POST['name']);
        $messages['data']['name'] = $name;
    }

    // Email
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $messages["errors"][] = "Email is not valid";
        $has_err = true;
    } else {
        $email = validate_input($_POST['email']);
        $messages['data']['email'] = $email;
    }

    if (!$has_err) {
        require_once _ROOT_DIR . "model/UserModel.php";

        $messages['data']['users'] = _view_users($name, $email);
        _set_session_val("messages", $messages);
        header("Location: ../user/admin/view-users.php");
    } else {
        _set_session_val("messages", $messages);
        header("Location: ../user/admin/view-users.php");
        exit();
    }
} else {
    header("Location: ../user/admin/view-users.php");
    exit();
}
