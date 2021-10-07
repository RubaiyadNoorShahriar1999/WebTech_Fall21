<?php

$name = "";
$name_err = "";

$email = "";
$email_err = "";

$dob = "";
$dob_err = "";

$gender = "";
$gender_err = "";

$degree = "";
$degree_err = "";

$bloodgrp = "";
$bloodgrp_err = "";

if (isset($_POST["submit"])) {
    // Name
    if(empty($_POST['name'])) {
        $name_err = "Name is required";
    } else if(strlen($_POST['name']) < 2) {
        $name_err = "Name must be greater than 2 character";
    } else if(preg_match("/^[a-zA-Z-.]/", $_POST['name']) != 1) {
        $name_err = "Name must be contains alpha character, (.) and (-)";
    } else {
        $name = validate_input($_POST['name']);
    }

    // Email
    if(empty($_POST['email'])) {
        $email_err = "Email is required";
    } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Email is not valid";
    } else {
        $email = validate_input($_POST['email']);
    }

    // DOB
    if(empty($_POST['dob'])) {
        $dob_err = "Date of birth is required";
    } else if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['dob']) != 1) {
        $dob_err = "Date of birth is not valid";
    } else {
        $dob = validate_input($_POST['dob']);
    }

    // Gender
    if(empty($_POST['gender'])) {
        $gender_err = "Date of birth is required";
    } else {
        $gender = validate_input($_POST['gender']);
    }

    // Gender
    if(!isset($_POST['degree'])) {
        $degree_err = "Degree is required";
    } else if(count($_POST['degree']) < 2) {
        $degree_err = "At lease 2 option is required";
    } else {
        $degree = $_POST['degree'];
        // var_dump($_POST['degree']);
    }

    // Blood Group
    if(empty($_POST['bloodgrp'])) {
        $bloodgrp_err = "Blood group is required";
    } else {
        $bloodgrp = $_POST['bloodgrp'];
        // var_dump($bloodgrp);
    }
}

function validate_input($str) {
    return htmlspecialchars(trim($str));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lab 2 Task 1</title>

    <style>
        .err {
            color: red;
        }
    </style>
</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend>
                <label for="name">Name</label>
            </legend>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>">
            <span class="err"><?php echo $name_err; ?></span>
        </fieldset>

        <fieldset>
            <legend>
                <label for="email">Email</label>
            </legend>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>">
            <span class="err"><?php echo $email_err ?></span>
        </fieldset>

        <fieldset>
            <legend>
                <label for="dob">Date Of Birth</label>
            </legend>
            <input type="date" name="dob" id="dob" value="<?php echo $dob; ?>">
            <span class="err"><?php echo $dob_err ?></span>
        </fieldset>

        <fieldset>
            <legend>
                <label for="gender">Gender</label>
            </legend>
            <input type="radio" name="gender" value="male" id="male"<?php echo ($gender == "male") ? " checked": ""; ?>><label for="male">Male</label>
            <input type="radio" name="gender" value="female" id="female"<?php echo ($gender == "female") ? " checked": ""; ?>><label for="female">Female</label>
            <input type="radio" name="gender" value="other" id="other"<?php echo ($gender == "other") ? " checked": ""; ?>><label for="other">Other</label>
            <span class="err"><?php echo $gender_err ?></span>
        </fieldset>

        <fieldset>
            <legend>
                <label for="degree">Degree</label>
            </legend>
            <input type="checkbox" name="degree[]" value="ssc" id="ssc"<?php echo (is_array($degree) && count($degree) > 1 && in_array("ssc", $degree)) ? " checked": ""; ?>><label for="ssc">SSC</label>
            <input type="checkbox" name="degree[]" value="hsc" id="hsc"<?php echo (is_array($degree) && count($degree) > 1 && in_array("hsc", $degree)) ? " checked": ""; ?>><label for="hsc">HSC</label>
            <input type="checkbox" name="degree[]" value="bsc" id="bsc"<?php echo (is_array($degree) && count($degree) > 1 && in_array("bsc", $degree)) ? " checked": ""; ?>><label for="bsc">BSc</label>
            <input type="checkbox" name="degree[]" value="msc" id="msc"<?php echo (is_array($degree) && count($degree) > 1 && in_array("msc", $degree)) ? " checked": ""; ?>><label for="msc">MSc</label>
            <span class="err"><?php echo $degree_err ?></span>
        </fieldset>

        <fieldset>
            <legend>
                <label for="bloodgrp">Blood Group</label>
            </legend>
            <select name="bloodgrp" id="bloodgrp">
                <option selected></option>
                <option value="a+"<?php echo ($bloodgrp == "a+") ? " selected": ""; ?>>A+</option>
                <option value="a-"<?php echo ($bloodgrp == "a-") ? " selected": ""; ?>>A-</option>
                <option value="b+"<?php echo ($bloodgrp == "b+") ? " selected": ""; ?>>B+</option>
                <option value="b-"<?php echo ($bloodgrp == "b-") ? " selected": ""; ?>>B-</option>
                <option value="o+"<?php echo ($bloodgrp == "o+") ? " selected": ""; ?>>O+</option>
                <option value="o-"<?php echo ($bloodgrp == "o-") ? " selected": ""; ?>>O-</option>
                <option value="ab+"<?php echo ($bloodgrp == "ab+") ? " selected": ""; ?>>AB+</option>
                <option value="ab-"<?php echo ($bloodgrp == "ab-") ? " selected": ""; ?>>AB-</option>
            </select>
            <span class="err"><?php echo $bloodgrp_err ?></span><br><br>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>

</body>

</html>