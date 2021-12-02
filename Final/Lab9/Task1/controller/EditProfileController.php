<?php


if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit();
}

$has_err = false;
$has_duplicate = false;
$success_msg = "";
$unsuccess_msg = "";

$name = "";
$err_name = "";

$email = "";
$err_email = "";

$gender = "";
$err_gender = "";

$dob = "";
$err_dob = "";

if (isset($_POST['edit'])) {
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

    // Gender
    if (empty($_POST['gender'])) {
        $err_gender = "Date of birth is required";
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
    // _var_dump($has_err);
    // _var_dump($_SESSION);
    // exit;

    if (!$has_err) {
        require_once _ROOT_DIR . "models/User/UsersModel.php";

        // Check duplication
        if ($_SESSION['email'] != $email) {
            $duplicate_email = getUserByEmail($email);

            if (($duplicate_email)) {
                $err_email = "Email already registered";
                $has_duplicate = true;
            }
        }

        // Update
        if (!$has_duplicate) {
            $update_user = getUserById($_SESSION['id']);

            // _var_dump($update_user);
            // exit();

            if ($update_user) {
                $user = new User();

                $user->setId($update_user['u_id']);
                $user->setName($name);
                $user->setEmail($email);
                $user->setGender($gender);
                $user->setDob($dob);


                $is_updated = updateUser($user);

                // _var_dump($is_updated);
                // exit;

                if ($is_updated) {

                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['gender'] = $gender;
                    $_SESSION['dob'] = $dob;

                    $success_msg = "Successfully Edited";
                    $unsuccess_msg = "";
                } else {
                    $success_msg = "";
                    $unsuccess_msg = "No Change !!";
                }
            }
        }
    }
}
