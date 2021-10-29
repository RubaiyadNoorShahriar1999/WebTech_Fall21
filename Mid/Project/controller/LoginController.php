<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(dirname(__FILE__)) . "/helper/functions.php";

if (isset($_POST['login'])) {
    // _var_dump($_POST);
    $has_err = false;
    $messages = [
        "errors" => [],
        "success" => [],
        "data" => []
    ];

    $email = "";
    $password = "";
    $utype = "";
    $rememberme = "";

    // _var_dump($_POST);
    // return;

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
    } else {
        $password = trim($_POST['password']);
        $messages['data']['password'] = $password;
    }

    // User Type
    if (empty($_POST['utype'])) {
        $messages["errors"][] = "User Type is required";
        $has_err = true;
    } else if (preg_match("/(doctor|patient|edoctor|admin)/", $_POST['utype']) != 1) {
        $messages["errors"][] = "User Type is invalid";
        $has_err = true;
    } else {
        $utype = validate_input($_POST['utype']);
        $messages['data']['utype'] = $utype;
    }

    // Remember me
    if (isset($_POST['rememberme']) && preg_match("/(on|off)/", $_POST['rememberme']) != 1) {
        $messages["errors"][] = "Remember me value is invalid";
        $has_err = true;
    } else if (isset($_POST['rememberme'])) {
        $rememberme = validate_input($_POST['rememberme']);
        $messages['data']['rememberme'] = $rememberme;
    }

    // _var_dump($_POST);
    // _var_dump($messages);
    // return;

    // Store data in JSON
    if (!$has_err) {
        require_once _ROOT_DIR . "model/UserModel.php";

        if (_get_user_login($email, $password, $utype)) {
            if ($rememberme == "on") {
                $params = session_get_cookie_params();

                setcookie('email', $_SESSION['email'], time() + _CONFIG['EXPIRED'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
                setcookie('utype', $_SESSION['utype'], time() + _CONFIG['EXPIRED'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            }

            $messages = [
                "errors" => [],
                "success" => [],
                "data" => []
            ];

            _set_session_val("messages", $messages);
            header("Location: ../login.php");
        } else {
            $messages["errors"][] = "Your credential is not correct";
            _set_session_val("messages", $messages);
            header("Location: ../login.php");
        }
    } else {
        _set_session_val("messages", $messages);
        header("Location: ../login.php");
    }
} else {
    header("Location: ../login.php");
    exit();
}
