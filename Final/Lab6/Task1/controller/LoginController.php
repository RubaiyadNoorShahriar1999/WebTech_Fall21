
<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: dashboard.php");
    exit();
}

$has_err = false;
$credential_msg = "";

$username = "";
$err_username = "";

$password = "";
$err_password = "";

$rememberme = "";
$err_rememberme = "";

if (isset($_POST['login'])) {
    // Username
    if (empty($_POST['username'])) {
        $err_username = "Username can't be empty";
        $has_err = true;
    } else {
        $username = validate_input($_POST['username']);
    }

    // Password
    if (empty($_POST['password'])) {
        $err_password = "Password can't be empty";
        $has_err = true;
    } else {
        $password = validate_input($_POST['password']);
    }

    // Remember me
    if (isset($_POST['rememberme']) && !preg_match("/(on|off)/", $_POST['rememberme'])) {
        $err_rememberme = "Remember me value is invalid";
        $has_err = true;
    } else if (isset($_POST['rememberme'])) {
        $rememberme = validate_input($_POST['rememberme']);
    }

    // _var_dump($rememberme);
    // return;

    if (!$has_err) {
        require_once _ROOT_DIR . "models/User/UsersModel.php";

        $user = getAuthUser($username, $password);

        if ($user) {
            $_SESSION['id'] = $user['u_id'];
            $_SESSION['name'] = $user['u_name'];
            $_SESSION['email'] = $user['u_email'];
            $_SESSION['username'] = $user['u_username'];
            $_SESSION['password'] = $user['u_password'];
            $_SESSION['gender'] = $user['u_gender'];
            $_SESSION['dob'] = $user['u_dob'];
            $_SESSION['pp_path'] = $user['u_pp_path'];
            $_SESSION['loggedin'] = true;
        }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
            if ($rememberme == "on") {
                setcookie('username', $_SESSION['username'], time() + _CONFIG['EXPIRED']);
                setcookie('email', $_SESSION['email'], time() + _CONFIG['EXPIRED']);
            }

            header("Location: dashboard.php");
        } else {
            $credential_msg = "Your credential is not correct";
        }
    }
}
