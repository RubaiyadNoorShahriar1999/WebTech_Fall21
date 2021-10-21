<?php

session_start();

// $_SESSION['loggedin'] = false;

function validate_input($str)
{
    return htmlspecialchars(trim($str));
}

function remember_me_loggedin()
{
    if (!empty($_COOKIE['username']) && !empty($_COOKIE['email'])) {
        // Get data from json
        $users = json_decode(file_get_contents("db/users.json"), true);

        // Login auto if cookies found
        if (!empty($users)) {
            foreach ($users as $user) {
                if ($user['email'] == $_COOKIE['email'] && $user['username'] == $_COOKIE['username']) {

                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['password'] = $user['password'];
                    $_SESSION['gender'] = $user['gender'];
                    $_SESSION['dob'] = $user['dob'];
                    $_SESSION['pp_path'] = $user['pp_path'];
                    $_SESSION['loggedin'] = true;

                    break;
                }
            }
        }

        return true;
    }

    return false;
}

remember_me_loggedin();

include_once "templates/header.php";
include_once "templates/footer.php";
include_once "templates/menu.php";

// echo '<pre>';
// var_dump($_COOKIE);
// echo '</pre>';