<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(dirname(__FILE__)) . "/helper/functions.php";

if (isset($_POST['registration'])) {

    $has_err = false;
    $has_duplicate = false;
    $messages = [
        "errors" => [],
        "success" => [],
        "data" => []
    ];

    $name = "";
    $email = "";
    $password = "";
    $cpassword = "";
    $gender = "";
    $utype = "";
    $dob = "";
    $privacy = "";

    // _var_dump($_POST);
    // return;

    // Name
    if (empty($_POST['name'])) {
        $messages["errors"][] = "Name is required";
        $has_err = true;
    } else if (strlen($_POST['name']) < 2) {
        $messages["errors"][] = "Name must be greater than 2 character";
        $has_err = true;
    } else if (preg_match("/^[a-zA-Z-.]/", $_POST['name']) != 1) {
        $messages["errors"][] = "Name must be contains alpha character, (.) and (-)";
        $has_err = true;
    } else {
        $name = validate_input($_POST['name']);
        $messages['data']['name'] = $name;
    }

    // Email
    if (empty($_POST['email'])) {
        $messages["errors"][] = "Email is required";
        $has_err = true;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $messages["errors"][] = "Email is not valid";
        $has_err = true;
    } else {
        $email = validate_input($_POST['email']);
        $messages['data']['email'] = $email;
    }

    // Password
    if (empty($_POST['password'])) {
        $messages["errors"][] = "Password is required";
        $has_err = true;
    } else if (strlen(trim($_POST['password'])) < 8) {
        $messages["errors"][] = "Password must be 8 characters or greater";
        $has_err = true;
    } else if (!preg_match("/[@#$%]+/", $_POST['password'])) {
        $messages["errors"][] = "Password must include special characters (@ # $ %)";
        $has_err = true;
    } else {
        $password = trim($_POST['password']);
        $messages['data']['password'] = $password;
    }

    // Confirm Password
    if (empty($_POST['cpassword'])) {
        $messages["errors"][] = "Confirm Password is required";
        $has_err = true;
    } else if ($_POST['cpassword'] != $_POST['password']) {
        $messages["errors"][] = "Confirm Password must equal to Password";
        $has_err = true;
    } else {
        $cpassword = trim($_POST['cpassword']);
        $messages['data']['cpassword'] = $cpassword;
    }

    // Gender
    if (empty($_POST['gender'])) {
        $messages["errors"][] = "Gender is required";
        $has_err = true;
    } else if (preg_match("/(male|female|other)/", $_POST['gender']) != 1) {
        $messages["errors"][] = "Gender is invalid";
        $has_err = true;
    } else {
        $gender = validate_input($_POST['gender']);
        $messages['data']['gender'] = $gender;
    }

    // User Type
    if (empty($_POST['utype'])) {
        $messages["errors"][] = "User Type is required";
        $has_err = true;
    } else if (preg_match("/(doctor|patient|edoctor)/", $_POST['utype']) != 1) {
        $messages["errors"][] = "User Type is invalid";
        $has_err = true;
    } else {
        $utype = validate_input($_POST['utype']);
        $messages['data']['utype'] = $utype;
    }

    // DOB
    if (isset($_POST['dob']) && empty($_POST['dob'])) {
        $messages["errors"][] = "Date of birth is required";
        $has_err = true;
    } else if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['dob']) != 1) {
        $messages["errors"][] = "Date of birth is not valid";
        $has_err = true;
    } else {
        $dob = validate_input($_POST['dob']);
        $messages['data']['dob'] = $dob;
    }

    // Terms and Conditions
    if (!isset($_POST['privacy'])) {
        $messages["errors"][] = "Terms and Condition is required";
        $has_err = true;
    } else if (preg_match("/(on|off)/", $_POST['privacy']) != 1) {
        $messages["errors"][] = "Terms and Condition is invalid";
        $has_err = true;
    } else {
        $privacy = validate_input($_POST['privacy']);
        $messages['data']['privacy'] = $privacy;
    }

    // _var_dump($_POST);
    // return;
    // _var_dump($messages);
    // return;

    // Store data in JSON
    if (!$has_err) {

        require_once _ROOT_DIR . "model/UserModel.php";

        if (!_is_duplication($messages, $email)) {


            _add_user($name, $email, $password, $gender, $utype, $dob);

            // Send successful message
            $messages = [
                "errors" => [],
                "success" => [
                    "Successfully Registered"
                ],
                "data" => []
            ];
            _set_session_val("messages", $messages);
            header("Location: ../registration.php");
        } else {
            _set_session_val("messages", $messages);
            header("Location: ../registration.php");
            exit();
        }
    } else {
        _set_session_val("messages", $messages);
        header("Location: ../registration.php");
        exit();
    }
} else {
    header("Location: ../registration.php");
    exit();
}
