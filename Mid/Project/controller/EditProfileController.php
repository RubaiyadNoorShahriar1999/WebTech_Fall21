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

if (isset($_POST['editprofile'])) {

    $has_err = false;
    // $has_duplicate = false;
    $messages = [
        "errors" => [],
        "success" => [],
        "data" => []
    ];

    $name = "";
    $email = "";
    $gender = "";
    $dob = "";

    $degree = "";
    $institute = "";
    $specialization = "";
    $work_area = "";

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
        // $messages['data']['name'] = $name;
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
        // $messages['data']['email'] = $email;
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
        // $messages['data']['gender'] = $gender;
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
        // $messages['data']['dob'] = $dob;
    }

    if (preg_match("/(doctor|edoctor)/", _get_session_val("utype")) == 1) {
        // Degree
        if (empty($_POST['degree'])) {
            $messages["errors"][] = "Degree is required";
            $has_err = true;
        } else if (strlen($_POST['degree']) < 2) {
            $messages["errors"][] = "Degree must be greater than 2 character";
            $has_err = true;
        } else {
            $degree = validate_input($_POST['degree']);
            // $messages['data']['degree'] = $degree;
        }

        // Institute
        if (empty($_POST['institute'])) {
            $messages["errors"][] = "Institute is required";
            $has_err = true;
        } else if (strlen($_POST['institute']) < 2) {
            $messages["errors"][] = "Institute must be greater than 2 character";
            $has_err = true;
        } else {
            $institute = validate_input($_POST['institute']);
            // $messages['data']['degree'] = $institute;
        }

        // Specialization
        if (empty($_POST['specialization'])) {
            $messages["errors"][] = "Specialization is required";
            $has_err = true;
        } else if (strlen($_POST['specialization']) < 2) {
            $messages["errors"][] = "Specialization must be greater than 2 character";
            $has_err = true;
        } else {
            $specialization = validate_input($_POST['specialization']);
            // $messages['data']['degree'] = $specialization;
        }
    }

    if (_get_session_val("utype") == "edoctor") {

        // Work Area
        if (empty($_POST['work_area'])) {
            $messages["errors"][] = "Work Area is required";
            $has_err = true;
        } else if (strlen($_POST['work_area']) < 2) {
            $messages["errors"][] = "Work Area must be greater than 2 character";
            $has_err = true;
        } else {
            $work_area = validate_input($_POST['work_area']);
            // $messages['data']['degree'] = $work_area;
        }
    }

    // _var_dump($_POST);
    // return;
    // _var_dump($messages);
    // return;

    // Store data in JSON
    if (!$has_err) {

        require_once _ROOT_DIR . "model/UserModel.php";

        if (_get_session_val("email") == $email || !_is_duplication($messages, $email)) {

            $user = [
                "name" => $name,
                "email" => $email,
                "gender" => $gender,
                "dob" => $dob
            ];

            if (_get_session_val("utype") == "doctor") {
                $user["degree"] = $degree;
                $user["institute"] = $institute;
                $user["specialization"] = $specialization;
            } else if (_get_session_val("utype") == "patient") {
            } else if (_get_session_val("utype") == "edoctor") {
                $user["degree"] = $degree;
                $user["institute"] = $institute;
                $user["specialization"] = $specialization;
                $user["work_area"] = $work_area;
            }

            // _var_dump($user);
            // return;

            _edit_user(_get_session_val("utype"), $user, _get_session_val('email'));

            // Send successful message
            $messages = [
                "errors" => [],
                "success" => [
                    "Successfully Edited"
                ],
                "data" => []
            ];
            _set_session_val("messages", $messages);
            header("Location: ../edit-profile.php");
        } else {
            _set_session_val("messages", $messages);
            header("Location: ../edit-profile.php");
            exit();
        }
    } else {
        _set_session_val("messages", $messages);
        header("Location: ../edit-profile.php");
        exit();
    }
} else {
    header("Location: ../edit-profile.php");
    exit();
}
