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

if (_get_session_val('utype') != "patient") {
    header("Location: ../dashboard.php");
    exit();
}

if (isset($_POST['appointment'])) {
    // _var_dump($_POST);
    // return;

    $has_err = false;
    $messages = [
        "errors" => [],
        "success" => [],
        "data" => []
    ];

    $docemail = "";

    // Doctor Email
    if (empty($_POST['docemail'])) {
        $messages["errors"][] = "Email is required";
        $has_err = true;
    } else if (!filter_var($_POST['docemail'], FILTER_VALIDATE_EMAIL)) {
        $messages["errors"][] = "Email is not valid";
        $has_err = true;
    } else {
        $docemail = validate_input($_POST['docemail']);
        $messages['data']['docemail'] = $docemail;
    }

    if (!$has_err) {
        require_once _ROOT_DIR . "model/UserModel.php";

        $is_appointed = _appointment_doctor($messages, $docemail);
        // return;
        if ($is_appointed) {
            $messages["success"][] = "Successfully Appointed";
            _set_session_val("messages", $messages);
            header("Location: ../user/patient/appointment.php");
        } else {
            $messages["errors"][] = "Unsuccessfull to Appointed";
            _set_session_val("messages", $messages);
            header("Location: ../user/patient/appointment.php");
        }
    } else {
        _set_session_val("messages", $messages);
        header("Location: ../user/patient/appointment.php");
        exit();
    }
} else {
    header("Location: ../user/patient/appointment.php");
    exit();
}
