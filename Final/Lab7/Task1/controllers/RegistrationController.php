<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(dirname(__FILE__)) . "/helper/functions.php";
require_once _ROOT_DIR . "controllers/ValidationController.php";

if (isset($_POST['registration'])) {

    $has_err = false;
    $messages = [
        "success" => "",
        "unsuccess" => "",
        "errors" => [],
        "data" => []
    ];

    $has_duplicate = false;

    $name = "";
    $email = "";
    $phone = "";
    $password = "";
    $cpassword = "";
    $gender = "";
    $utype = "";
    $dob = "";
    $privacy = "";

    // _var_dump($_POST);
    // return;


    // Name
    _validate_name($name, $_POST['name'], $messages, $has_err);

    // Email
    _validate_email($email, $_POST['email'], $messages, $has_err);

    // Phone
    _validate_phone($phone, $_POST['phone'], $messages, $has_err);

    // Password
    _validate_password($password, $_POST['password'], $messages, $has_err);

    // Confirm Password
    _validate_cpassword($cpassword, $_POST['cpassword'], $_POST['password'], $messages, $has_err);

    // Gender
    _validate_gender($gender, $_POST['gender'], $messages, $has_err);

    // User Type
    _validate_utype($utype, $_POST['utype'], $messages, $has_err);

    // DOB
    _validate_dob($dob, $_POST['dob'], $messages, $has_err);

    // Terms and Conditions
    _validate_privacy($privacy, $_POST['privacy'], $messages, $has_err);

    // _print_r([$name, $email, $password, $cpassword, $gender, $dob, $utype, $privacy]);
    // return;

    // Register the user if no errors found
    if (!$has_err) {

        // _print_r($messages['data']);

        // require_once _ROOT_DIR . "model/UserModel.php";

        // if (!_is_duplication($messages, $email)) {

        //     _add_user($name, $email, $password, $gender, $utype, $dob);

        //     // Send successful message
        //     $messages = [
        //         "errors" => [],
        //         "success" => [
        //             "Successfully Registered"
        //         ],
        //         "data" => []
        //     ];
        //     _set_session_val("messages", $messages);
        //     header("Location: ../registration.php");
        // } else {
        //     _set_session_val("messages", $messages);
        //     header("Location: ../registration.php");
        //     exit();
        // }

        switch ($utype) {
            case "doctor":

                // Doctor Registration

                break;

            case "emanager":

                // Emergency Manager Registration

                break;

            case "patient":

                // Patient Registration

                break;

            default:

                // Default

                break;
        }

        if ($utype === "doctor") {
            // require_once _ROOT_DIR . "model/Doctor/DoctorModel.php";

        } else if ($utype === "emanager") {
            // require_once _ROOT_DIR . "model/EManager/EManagerModel.php";

        } else if ($utype === "patient") {
            // require_once _ROOT_DIR . "model/Patient/PatientModel.php";

        }
    } else {
        _set_session_val("messages", $messages);
        header("Location: " . _get_url("registration.php"));
        exit();
    }
} else {
    header("Location: " . _get_url("registration.php"));
    exit();
}
