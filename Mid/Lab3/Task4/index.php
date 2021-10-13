<?php

$err_has = false;

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
        $err_has = true;
    } else if (strlen($_POST['name']) < 2) {
        $err_name = "Name must be greater than 2 character";
        $err_has = true;
    } else if (preg_match("/^[a-zA-Z-.]/", $_POST['name']) != 1) {
        $err_name = "Name must be contains alpha character, (.) and (-)";
        $err_has = true;
    } else {
        $name = validate_input($_POST['name']);
    }

    // Email
    if (empty($_POST['email'])) {
        $err_email = "Email is required";
        $err_has = true;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $err_email = "Email is not valid";
        $err_has = true;
    } else {
        $email = validate_input($_POST['email']);
    }

    // Username
    if (empty($_POST['username'])) {
        $err_username = "User Name is required";
        $err_has = true;
    } else if (strlen(trim($_POST['username'])) < 2) {
        $err_username = "User Name must be lager than 2 character";
        $err_has = true;
    } else if (preg_match("/^([a-zA-z0-9_-]*)$/", $_POST['username']) != 1) {
        $err_username = "User Name must be alphanumeric, dash (-) and Underscore (_)";
        $err_has = true;
    } else {
        $username = validate_input($_POST['username']);
    }

    // Password
    if (empty($_POST['password'])) {
        $err_password = "Password is required";
        $err_has = true;
    } else if (strlen(trim($_POST['password'])) < 8) {
        $err_password = "Password must be 8 characters or greater";
        $err_has = true;
    } else if (!preg_match("/[@#$%]+/", $_POST['password'])) {
        $err_password = "Password must include special characters (@ # $ %)";
        $err_has = true;
    } else {
        $password = trim($_POST['password']);
    }

    // Confirm Password
    if (empty($_POST['cpassword'])) {
        $err_cpassword = "Confirm Password is required";
        $err_has = true;
    } else if ($_POST['cpassword'] != $_POST['password']) {
        $err_cpassword = "Confirm Password must equal to Password";
        $err_has = true;
    } else {
        $cpassword = trim($_POST['cpassword']);
    }

    // Gender
    if (empty($_POST['gender'])) {
        $err_gender = "Date of birth is required";
        $err_has = true;
    } else {
        $gender = validate_input($_POST['gender']);
    }

    // DOB
    if (empty($_POST['dob'])) {
        $err_dob = "Date of birth is required";
        $err_has = true;
    } else if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['dob']) != 1) {
        $err_dob = "Date of birth is not valid";
        $err_has = true;
    } else {
        $dob = validate_input($_POST['dob']);
    }

    // echo $name, $email, $username, $password, $cpassword, $gender, $dob;

    // Store data in JSON
    if(!$err_has) {
        // Formate user associative array
        $user = [
            "name" => $name,
            "email" => $email,
            "username" => $username,
            "password" => $password,
            "gender" => $gender,
            "dob" => $dob
        ];

        // Get previous data from json
        $json_data = json_decode(file_get_contents("users.json"), true);

        // Append new user
        $json_data[] = $user;

        // Convert associative array to json string
        $json = json_encode($json_data);

        // Put all the json string to the file
        file_put_contents("users.json", $json);

        // echo '<pre>';
        // var_dump($json);
        // echo '</pre>';
    }
}

function validate_input($str)
{
    return htmlspecialchars(trim($str));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lab 3 Task 1</title>

    <style>
        table tr td:first-child {
            text-align: left;
            width: 200px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend>REGISTRATION</legend>
            <div>
                <table>
                    <tr>
                        <td><label for="name">Name</label></td>
                        <td>:<input type="text" name="name" id="name" value="<?php echo $name ?>"></td>
                        <td class="error"><?php echo $err_name ?></td>
                    </tr>
                </table>
                <hr>
                <table>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td>:<input type="text" name="email" id="email" value="<?php echo $email ?>"></td>
                        <td class="error"><?php echo $err_email ?></td>
                    </tr>
                </table>
                <hr>
                <table>
                    <tr>
                        <td><label for="username">User Name</label></td>
                        <td>:<input type="text" name="username" id="username" value="<?php echo $username ?>"></td>
                        <td class="error"><?php echo $err_username ?></td>
                    </tr>
                </table>
                <hr>
                <table>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td>:<input type="password" name="password" id="password" value="<?php echo $password ?>"></td>
                        <td class="error"><?php echo $err_password ?></td>
                    </tr>
                </table>
                <hr>
                <table>
                    <tr>
                        <td><label for="cpassword">Confirm Password</label></td>
                        <td>:<input type="password" name="cpassword" id="cpassword" value="<?php echo $cpassword ?>"></td>
                        <td class="error"><?php echo $err_cpassword ?></td>
                    </tr>
                </table>
                <hr>
                <fieldset>
                    <legend>Gender</legend>
                    <input type="radio" name="gender" value="male" id="male" <?php echo ($gender == "male") ? " checked" : ""; ?>><label for="male">Male</label>
                    <input type="radio" name="gender" value="female" id="female" <?php echo ($gender == "female") ? " checked" : ""; ?>><label for="female">Female</label>
                    <input type="radio" name="gender" value="other" id="other" <?php echo ($gender == "other") ? " checked" : ""; ?>><label for="other">Other</label>
                    <span class="error"><?php echo $err_gender; ?></span>
                </fieldset>
                <fieldset>
                    <legend>Date of Birth</legend>
                    <input type="date" name="dob" value="<?php echo $dob; ?>" id="dob">
                    <span class="error"><?php echo $err_dob; ?></span>
                </fieldset>
            </div>
            <div>
                <input type="submit" name="registration" value="Submit">
                <input type="reset" id="reset">
            </div>
        </fieldset>
    </form>

</body>

</html>