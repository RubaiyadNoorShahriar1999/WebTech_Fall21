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

if (_get_session_val('utype') != "doctor") {
    header("Location: ../dashboard.php");
    exit();
}

if (isset($_POST['viewappointments'])) {
    // _var_dump($_POST);
    // return;

    $has_err = false;
    $messages = [
        "errors" => [],
        "success" => [],
        "data" => []
    ];

    $patientemail = "";

    // Patient Email
    if (!empty($_POST['patientemail']) && !filter_var($_POST['patientemail'], FILTER_VALIDATE_EMAIL)) {
        $messages["errors"][] = "Email is not valid";
        $has_err = true;
    } else {
        $patientemail = validate_input($_POST['patientemail']);
        $messages['data']['patientemail'] = $patientemail;
    }

    if (!$has_err) {
        require_once _ROOT_DIR . "model/UserModel.php";

        $messages['data']['appointments'] = _view_appointments($patientemail);
        _set_session_val("messages", $messages);
        header("Location: ../user/doctor/view-appointment-list.php");
    } else {
        _set_session_val("messages", $messages);
        header("Location: ../user/doctor/view-appointment-list.php");
        exit();
    }
} else {
    header("Location: ../user/doctor/view-appointment-list.php");
    exit();
}
