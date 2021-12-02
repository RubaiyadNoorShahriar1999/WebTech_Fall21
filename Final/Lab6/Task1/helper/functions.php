<?php

/**
 * Start the session
 * for all `View page`
 */

session_start();

/**
 * 
 * Defined CONSTAN
 * 
 */

/**
 * return root directory
 * 
 * Example: `~\htdocs/MyProject/` from `xampp`
 */

define("_ROOT_DIR", dirname(__FILE__, 2) . "/");


/**
 * return all the configuration in array which is
 * defined in the `model/config.php` file
 * 
 * Example: `~\htdocs/MyProject/` from `xampp`
 * 
 * @return array
 */

define("_CONFIG", (file_exists(_ROOT_DIR . "models/config.php")) ? require_once(_ROOT_DIR . "models/config.php") : null);


/**
 * 
 * Display information with
 * proper formating using `var_dump()`
 * 
 * @param expression $expression
 * @return null
 */

function _var_dump($expression)
{
    echo '<pre style="background-color: #191919;color: #cccccc;padding: 1rem;margin: 1rem;">';
    var_dump($expression);
    echo '</pre>';
}

// Example
// _var_dump($_SERVER);
// _var_dump(__FILE__);
// _var_dump(__DIR__);


/**
 * 
 * Display array information with
 * proper formating using `print_r()`
 * 
 * @param expression $expression
 * 
 * @return null
 */

function _print_r($expression)
{
    echo '<pre style="background-color: #191919;color: #cccccc;padding: 1rem;margin: 1rem;">';
    print_r($expression);
    echo '</pre>';
}

function validate_input($str)
{
    return htmlspecialchars(trim($str));
}

function remember_me_loggedin()
{
    if (!empty($_COOKIE['username']) && !empty($_COOKIE['email'])) {
        require_once _ROOT_DIR . "models/User/UsersModel.php";

        $user = getRememberMeAuthUser($_COOKIE['username'], $_COOKIE['email']);

        // _var_dump($user);
        // return;

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

        return true;
    }

    return false;
}

remember_me_loggedin();

include_once _ROOT_DIR . "templates/header.php";
include_once _ROOT_DIR . "templates/footer.php";
include_once _ROOT_DIR . "templates/menu.php";

// _var_dump($_COOKIE);