<?php

require_once dirname(__FILE__, 2) . '/helper/functions.php';


/**
 * 
 * Validation Controller
 * 
 */

function _validate_name(&$name, &$_name, &$messages, &$has_err)
{
    if (empty($_name)) {
        $messages["errors"]['name'] = "Name is required";
        $has_err = true;
    } else if (strlen($_name) < 2) {
        $messages["errors"]['name'] = "Name must be greater than 2 character";
        $has_err = true;
    } else if (preg_match("/^[a-zA-Z-.]/", $_name) != 1) {
        $messages["errors"]['name'] = "Name must be contains alpha character, (.) and (-)";
        $has_err = true;
    } else {
        $name = validate_input($_name);
        $messages['data']['name'] = $name;
    }
}

function _validate_email(&$email, &$_email, &$messages, &$has_err)
{
    if (empty($_email)) {
        $messages["errors"]['email'] = "Email is required";
        $has_err = true;
    } else if (!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
        $messages["errors"]['email'] = "Email is not valid";
        $has_err = true;
    } else {
        $email = validate_input($_email);
        $messages['data']['email'] = $email;
    }
}

/**
 * Regular Expression
 * 
 * @see https://regexr.com/69opj
 */

function _validate_phone(&$phone, &$_phone, &$messages, &$has_err)
{
    if(empty($_phone)) {
        $messages["errors"]['phone'] = "Phone is required";
        $has_err = true;
    } else if(preg_match("/^(\+88)?01[2-9]{1}[0-9]{8}$/", $_phone) != 1) {
        $messages["errors"]['phone'] = "Invalid Phone! valid is +8801234567890, 01234567890";
        $has_err = true;
    } else {
        $phone = validate_input($_phone);
        $messages['data']['phone'] = $phone;
    }
}

function _validate_password(&$password, &$_password, &$messages, &$has_err)
{
    if (empty($_password)) {
        $messages["errors"]['password'] = "Password is required";
        $has_err = true;
    } else if (strlen($_password) < 8) {
        $messages["errors"]['password'] = "Password must be 8 characters or greater";
        $has_err = true;
    } else if (!preg_match("/[@#$%]+/", $_password)) {
        $messages["errors"]['password'] = "Password must include special characters (@ # $ %)";
        $has_err = true;
    } else {
        // $password = password_hash($_password, PASSWORD_DEFAULT);
        $password = $_password;
        $messages['data']['password'] = $password;
    }
}

function _validate_cpassword(&$cpassword, &$_cpassword, &$_password, &$messages, &$has_err)
{
    if (empty($_cpassword)) {
        $messages["errors"]['cpassword'] = "Confirm Password is required";
        $has_err = true;
    } else if ($_cpassword !== $_password) {
        $messages["errors"]['cpassword'] = "Confirm Password must equal to Password";
        $has_err = true;
    } else {
        // $cpassword = password_hash($_cpassword, PASSWORD_DEFAULT);
        $cpassword = $_cpassword;
        $messages['data']['cpassword'] = $cpassword;
    }
}

function _validate_gender(&$gender, &$_gender, &$messages, &$has_err)
{
    if (empty($_gender)) {
        $messages["errors"]['gender'] = "Gender is required";
        $has_err = true;
    } else if (preg_match("/(male|female|other)/", $_gender) != 1) {
        $messages["errors"]['gender'] = "Gender is invalid";
        $has_err = true;
    } else {
        $gender = validate_input($_gender);
        $messages['data']['gender'] = $gender;
    }
}

function _validate_utype(&$utype, &$_utype, &$messages, &$has_err)
{
    if (empty($_utype)) {
        $messages["errors"]['utype'] = "User Type is required";
        $has_err = true;
    } else if (preg_match("/(doctor|patient|emanager|admin)/", $_utype) != 1) {
        $messages["errors"]['utype'] = "User Type is invalid";
        $has_err = true;
    } else {
        $utype = validate_input($_utype);
        $messages['data']['utype'] = $utype;
    }
}

function _validate_dob(&$dob, &$_dob, &$messages, &$has_err)
{
    if (isset($_dob) && empty($_dob)) {
        $messages["errors"]['dob'] = "Date of birth is required";
        $has_err = true;
    } else if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $_dob) != 1) {
        $messages["errors"]['dob'] = "Date of birth is not valid";
        $has_err = true;
    } else {
        $dob = validate_input($_dob);
        $messages['data']['dob'] = $dob;
    }
}

function _validate_privacy(&$privacy, &$_privacy, &$messages, &$has_err)
{
    if (!isset($_privacy)) {
        $messages["errors"]['privacy'] = "Terms and Condition is required";
        $has_err = true;
    } else if (preg_match("/(on|off)/", $_privacy) != 1) {
        $messages["errors"]['privacy'] = "Terms and Condition is invalid";
        $has_err = true;
    } else {
        $privacy = validate_input($_privacy);
        $messages['data']['privacy'] = $privacy;
    }
}

/**
 * 
 * Login Validation Controller
 * 
 */

function _validate_email_login(&$email, &$_email, &$messages, &$has_err)
{
    if (empty($_email)) {
        $messages["errors"]['email'] = "Email is required";
        $has_err = true;
    } else if (!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
        $messages["errors"]['email'] = "Email is not valid";
        $has_err = true;
    } else {
        $email = validate_input($_email);
        $messages['data']['email'] = $email;
    }
}

function _validate_password_login(&$password, &$_password, &$messages, &$has_err)
{
    if (empty($_password)) {
        $messages["errors"]['password'] = "Password is required";
        $has_err = true;
    } else {
        // $password = password_hash($_password, PASSWORD_DEFAULT);
        $password = $_password;
        $messages['data']['password'] = $password;
    }
}

function _validate_utype_login(&$utype, &$_utype, &$messages, &$has_err)
{
    if (empty($_utype)) {
        $messages["errors"]['utype'] = "User Type is required";
        $has_err = true;
    } else if (preg_match("/(doctor|patient|emanager|admin)/", $_utype) != 1) {
        $messages["errors"]['utype'] = "User Type is invalid";
        $has_err = true;
    } else {
        $utype = validate_input($_utype);
        $messages['data']['utype'] = $utype;
    }
}

function _validate_rememberme_login(&$rememberme, &$_rememberme, &$messages, &$has_err)
{
    if (isset($_rememberme) && preg_match("/(on|off)/", $_rememberme) != 1) {
        $messages["errors"]['rememberme'] = "Remember me value is invalid";
        $has_err = true;
    } else if (isset($_rememberme)) {
        $rememberme = validate_input($_rememberme);
        $messages['data']['rememberme'] = $rememberme;
    }
}
