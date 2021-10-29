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

if (isset($_POST['ambulance'])) {
    // _var_dump($_POST);
    // return;

    $has_err = false;
    $messages = [
        "errors" => [],
        "success" => [],
        "data" => []
    ];

    $reason = "";

    // Doctor Email
    if (empty($_POST['reason'])) {
        $messages["errors"][] = "Reason is required";
        $has_err = true;
    } else {
        $reason = validate_input($_POST['reason']);
        $messages['data']['reason'] = $reason;
    }

    if (!$has_err) {
        require_once _ROOT_DIR . "model/UserModel.php";

        $is_appointed = _request_ambulance($reason);
        // return;
        if ($is_appointed) {
            $messages["success"][] = "Successfully Requested";
            _set_session_val("messages", $messages);
            header("Location: ../user/patient/ambulance.php");
        } else {
            $messages["errors"][] = "Unsuccessfull to Requested";
            _set_session_val("messages", $messages);
            header("Location: ../user/patient/ambulance.php");
        }
    } else {
        _set_session_val("messages", $messages);
        header("Location: ../user/patient/ambulance.php");
        exit();
    }
} else {
    header("Location: ../user/patient/ambulance.php");
    exit();
}
