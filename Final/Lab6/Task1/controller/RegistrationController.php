<?php

$has_err = false;
$has_duplicate = false;
$success_msg = "";
$unsuccess_msg = "";

$name = "";
$err_name = "";

$email = "";
$err_email = "";

$username = "";
$err_username = "";

$password = "";
$err_password = "";

$cpassword = "";
$err_cpassword = "";

$gender = "";
$err_gender = "";

$dob = "";
$err_dob = "";

if (isset($_POST['registration'])) {
    // Name
    if (empty($_POST['name'])) {
        $err_name = "Name is required";
        $has_err = true;
    } else if (strlen($_POST['name']) < 2) {
        $err_name = "Name must be greater than 2 character";
        $has_err = true;
    } else if (preg_match("/^[a-zA-Z-.]/", $_POST['name']) != 1) {
        $err_name = "Name must be contains alpha character, (.) and (-)";
        $has_err = true;
    } else {
        $name = validate_input($_POST['name']);
    }

    // Email
    if (empty($_POST['email'])) {
        $err_email = "Email is required";
        $has_err = true;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $err_email = "Email is not valid";
        $has_err = true;
    } else {
        $email = validate_input($_POST['email']);
    }

    // Username
    if (empty($_POST['username'])) {
        $err_username = "User Name is required";
        $has_err = true;
    } else if (strlen(trim($_POST['username'])) < 2) {
        $err_username = "User Name must be lager than 2 character";
        $has_err = true;
    } else if (preg_match("/^([a-zA-z0-9_-]*)$/", $_POST['username']) != 1) {
        $err_username = "User Name must be alphanumeric, dash (-) and Underscore (_)";
        $has_err = true;
    } else {
        $username = validate_input($_POST['username']);
    }

    // Password
    if (empty($_POST['password'])) {
        $err_password = "Password is required";
        $has_err = true;
    } else if (strlen(trim($_POST['password'])) < 8) {
        $err_password = "Password must be 8 characters or greater";
        $has_err = true;
    } else if (!preg_match("/[@#$%]+/", $_POST['password'])) {
        $err_password = "Password must include special characters (@ # $ %)";
        $has_err = true;
    } else {
        $password = trim($_POST['password']);
    }

    // Confirm Password
    if (empty($_POST['cpassword'])) {
        $err_cpassword = "Confirm Password is required";
        $has_err = true;
    } else if ($_POST['cpassword'] != $_POST['password']) {
        $err_cpassword = "Confirm Password must equal to Password";
        $has_err = true;
    } else {
        $cpassword = trim($_POST['cpassword']);
    }

    // Gender
    if (empty($_POST['gender'])) {
        $err_gender = "Gender is required";
        $has_err = true;
    } else {
        $gender = validate_input($_POST['gender']);
    }

    // DOB
    if (empty($_POST['dob'])) {
        $err_dob = "Date of birth is required";
        $has_err = true;
    } else if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['dob']) != 1) {
        $err_dob = "Date of birth is not valid";
        $has_err = true;
    } else {
        $dob = validate_input($_POST['dob']);
    }

    // _var_dump($_POST);
    // return;

    if (!$has_err) {
        require_once _ROOT_DIR . "models/User/UsersModel.php";

        $new_user = new User();

        $new_user->setName($name);
        $new_user->setUsername($username);
        $new_user->setEmail($email);
        $new_user->setPassword($password);
        $new_user->setDob($dob);
        $new_user->setGender($gender);


        // Check duplication
        $duplicate_username = getUserByUsername($new_user->getUsername());
        $duplicate_email = getUserByEmail($new_user->getEmail());

        if (($duplicate_username)) {
            $err_username = "Username already registered";
            $has_duplicate = true;
            
        }
        
        if (($duplicate_email)) {
            $err_email = "Email already registered";
            $has_duplicate = true;
        }

        // Register
        if (!$has_duplicate) {
            if (addUser($new_user)) {
                $success_msg = "Successfully Registered";
                $unsuccess_msg = "";
            } else {
                $success_msg = "";
                $unsuccess_msg = "Unsuccessfully Registered";
            }
        }
    }
}