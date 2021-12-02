<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(__FILE__, 2) . "/helper/functions.php";
require_once _ROOT_DIR . "controllers/ValidationController.php";

if (isset($_POST['login'])) {

    $has_err = false;
    $messages = [
        "success" => "",
        "unsuccess" => "",
        "errors" => [],
        "data" => []
    ];

    $email = "";
    $password = "";
    $utype = "";
    $rememberme = "";

    // _var_dump($_POST);
    // return;

    // Email
    _validate_email_login($email, $_POST['email'], $messages, $has_err);

    // Password
    _validate_password_login($password, $_POST['password'], $messages, $has_err);

    // User Type
    _validate_utype_login($utype, $_POST['utype'], $messages, $has_err);

    // Remember me
    _validate_rememberme_login($rememberme, $_POST['rememberme'], $messages, $has_err);


    // _print_r([$email, $password, $utype, $rememberme]);
    // return;

    // Login the user if no errors found
    if (!$has_err) {

        $auth_user = null;



        /*
        if ($utype === "admin") {
            require_once _ROOT_DIR . "model/Admin/AdminModel.php";

            $auth_user = AdminModel::authenticate($email, $password);

            // _var_dump($auth_user);

            // _set_session_val('id', $auth_user['a_id']);
            // _set_session_val('name', $auth_user['a_name']);
            // _set_session_val('email', $auth_user['a_email']);
            // _set_session_val('password', $auth_user['a_password']);
            // _set_session_val('gender', $auth_user['a_gender']);
            // _set_session_val('dob', $auth_user['a_dob']);
            // _set_session_val('utype', $auth_user['a_utype']);
            // _set_session_val('pp_path', $auth_user['a_pp_path']);
            // _set_logged_in(true);

            // _var_dump($_SESSION);
            // exit();

        } else if ($utype === "doctor") {
            // require_once _ROOT_DIR . "model/Doctor/DoctorModel.php";

            // $auth_user = DoctorModel::authenticate($email, $password);

            // _set_session_val("degree", $auth_user['degree']);
            // _set_session_val("institute", $auth_user['institute']);
            // _set_session_val("specialization", $auth_user['specialization']);

            // _set_logged_in(true);

            // _var_dump($auth_user);

        } else if ($utype === "emanager") {
            // require_once _ROOT_DIR . "model/EManager/EManagerModel.php";

            // $auth_user = EManagerModel::authenticate($email, $password);

            // Set all the user data in session

            // _set_session_val("degree", $auth_user['degree']);
            // _set_session_val("institute", $auth_user['institute']);
            // _set_session_val("specialization", $auth_user['specialization']);
            // _set_session_val("work_area", $auth_user['work_area']);

            // _set_logged_in(true);

            // _var_dump($auth_user);

        } else if ($utype === "patient") {
            // require_once _ROOT_DIR . "model/Patient/PatientModel.php";

            // $auth_user = PatientModel::authenticate($email, $password);

            // Set all the user data in session

            // _set_session_val('id', $auth_user['a_id']);
            // _set_session_val('name', $auth_user['a_name']);
            // _set_session_val('email', $auth_user['a_email']);
            // _set_session_val('password', $auth_user['a_password']);
            // _set_session_val('gender', $auth_user['a_gender']);
            // _set_session_val('dob', $auth_user['a_dob']);
            // _set_session_val('utype', $auth_user['a_utype']);
            // _set_session_val('pp_path', $auth_user['a_pp_path']);
            // _set_logged_in(true);

            // _var_dump($auth_user);

        }
        */

        switch ($utype) {
            case "admin":

                // Admin Login

                break;

            case "doctor":

                // Doctor Login

                break;

            case "emanager":

                // Emergency Manager Login

                break;

            case "patient":

                // Patient Login

                break;

            default:

                // Default
                $auth_user = null;

                break;
        }

        if ($auth_user !== null && count($auth_user) && $auth_user) {
            // _set_logged_in(true);
            // Set remember me if checked
            if ($rememberme === "on") {
                $params = session_get_cookie_params();

                setcookie('email', _get_session_val('email'), time() + _CONFIG['EXPIRED'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
                setcookie('utype', _get_session_val('utype'), time() + _CONFIG['EXPIRED'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            }

            $messages["success"] = "Login Successful";
            _set_session_val("messages", $messages);
            header("Location: " . _get_url("dashboard/index.php"));
            exit();
        } else {
            $messages["unsuccess"] = "Your credential is not correct";
            _set_session_val("messages", $messages);
            header("Location: " . _get_url("login.php"));
            exit();
        }
    } else {
        _set_session_val("messages", $messages);
        header("Location: " . _get_url("login.php"));
        exit();
    }
} else {
    header("Location: " . _get_url("login.php"));
    exit();
}
