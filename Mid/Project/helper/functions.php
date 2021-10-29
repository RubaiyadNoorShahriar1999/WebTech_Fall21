<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");


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

define("_ROOT_DIR", dirname(dirname(__FILE__)) . "/");


/**
 * return all the configuration in array which is
 * defined in the `model/config.php` file
 * 
 * Example: `~\htdocs/MyProject/` from `xampp`
 * 
 * @return array
 */

define("_CONFIG", (file_exists(_ROOT_DIR . "model/config.php")) ? require_once(_ROOT_DIR . "model/config.php") : null);


/**
 * Includes templates file
 */

if (file_exists(_ROOT_DIR . "templates/header.php")) {
    require_once(_ROOT_DIR . "templates/header.php");
}

if (file_exists(_ROOT_DIR . "templates/footer.php")) {
    require_once(_ROOT_DIR . "templates/footer.php");
}


if (file_exists(_ROOT_DIR . "templates/menu.php")) {
    require_once(_ROOT_DIR . "templates/menu.php");
}


/**
 * If Remember me cookie found
 */

function remember_me_loggedin()
{
    if (!empty($_COOKIE['email']) && !empty($_COOKIE['utype'])) {
        // _var_dump($_COOKIE);
        // Get data from json
        $users = json_decode(file_get_contents(_CONFIG['DB_DIR']), true);

        // Login auto if cookies found
        if (!empty($users)) {
            foreach ($users as $user) {
                if ($user['email'] === $_COOKIE['email'] && $user['utype'] === $_COOKIE['utype']) {

                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['password'] = $user['password'];
                    $_SESSION['gender'] = $user['gender'];
                    $_SESSION['dob'] = $user['dob'];
                    $_SESSION['utype'] = $user['utype'];
                    $_SESSION['pp_path'] = $user['pp_path'];
                    _set_logged_in(true);

                    if ($_SESSION['utype'] == "doctor") {
                        $_SESSION["degree"] = $user['degree'];
                        $_SESSION["institute"] = $user['institute'];
                        $_SESSION["specialization"] = $user['specialization'];
                    } else if ($_SESSION['utype'] == "patient") {
                    } else if ($_SESSION['utype'] == "edoctor") {
                        $_SESSION["degree"] = $user['degree'];
                        $_SESSION["institute"] = $user['institute'];
                        $_SESSION["specialization"] = $user['specialization'];
                        $_SESSION["work_area"] = $user['work_area'];
                    }
                    break;
                }
            }
        }
    }
}

remember_me_loggedin();


/**
 * 
 * Usefull Function
 * 
 */


/**
 * 
 * If `$_SESSION[$key]` is exist
 * return the value in it
 * otherwise return empty
 * `return mixed`
 * 
 * @return bool|null
 */

function _get_session_val($key)
{
    if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }
}


/**
 * 
 * If `$_SESSION[$key]` is set
 * return the value in it
 * otherwise return empty
 * `return mixed`
 * 
 * @return null
 */

function _set_session_val($key, $value)
{
    $_SESSION[$key] = $value;
}


/**
 * 
 * If `$_SESSION['loggedin']` is true
 * `return true`
 * otherwise `return false`
 * 
 * @return bool
 */

function _get_is_logged_in()
{
    if (isset($_SESSION['loggedin'])) {
        return $_SESSION['loggedin'] == true;
    }

    return false;
}


/**
 * 
 * Set the `$_SESSION['logged']`
 * if `session` is started
 * from given parameter
 * 
 * @param bool $loggedin
 * @return null
 */

function _set_logged_in(bool $loggedin)
{
    if (session_status() === 2) {
        $_SESSION['loggedin'] = $loggedin;
    }
}

// _var_dump(_set_logged_in(false)); // NULL

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

// Example
// _print_r([1,2,3,4,true,false,function(){}]);


/**
 * Generate base url
 * and it's return base url
 * depending on APP_NAME
 * in the config.php
 * 
 * Example: http://localhost/MyProject/
 * 
 * @return string formating string URL
 */

function _get_base_url()
{
    return sprintf(
        "%s://%s%s",
        (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== "off") ? "https" : "http",
        $_SERVER['SERVER_NAME'],
        (!empty(_CONFIG['APP_NAME'])) ? "/" . _CONFIG['APP_NAME'] . "/" : "/"
    );
}

// Example
// _var_dump(_get_base_url()); // http://localhost/MyProject/


/**
 * Generate url
 * and it's return url
 * depending on APP_NAME
 * in the config.php
 * 
 * Example: http://localhost/MyProject/login.php
 * 
 * @return string formating string URL
 */

function _get_url($path = "")
{
    return sprintf(
        "%s%s",
        _get_base_url(),
        (!empty($path)) ? $path : ""
    );
}

// Example
// _var_dump(_get_url("login.php")); // http://localhost/MyProject/login.php


/**
 * Generate Assets URI
 * and it's return Assets URI
 * 
 * Example: http://localhost/MyProject/assets/css/style.css
 * 
 * @param string $filename ""
 * @param string $assets_dir ""
 * 
 * @return string formating string Assets URI
 */

function _get_assets_uri(string $filename = "", string $assets_dir = "")
{
    $assets_url = _get_base_url() . "assets";
    $uri = "";

    $filename = !empty($filename) ? "/" . trim(trim($filename), "/") : "";
    $assets_dir = !empty($assets_dir) ? "/" . trim(trim($assets_dir), "/") : "";

    $uri .= $assets_url . $assets_dir . $filename;

    return $uri;
}

// Examples
// _var_dump(_get_assets_uri()); // http://localhost/MyProject/assets
// _var_dump(_get_assets_uri("script.js")); // http://localhost/MyProject/assets/script.js
// _var_dump(_get_assets_uri("", "js")); // http://localhost/MyProject/assets/js/
// _var_dump(_get_assets_uri("style.css", "css")); // http://localhost/MyProject/assets/css/style.css
// _var_dump(_get_assets_uri("script.js", "js/base/")); // http://localhost/MyProject/assets/js/base/script.js


function _print_messages($messages)
{
    if (count($messages['errors']) > 0) : ?>

        <div class="col-md-12 mb-5">

            <?php foreach ($messages['errors'] as $error) : ?>

                <div class="alert alert-danger fs-6 fst-italic fw-bold p-2 m-1" role="alert">
                    <?php echo "!! " . $error; ?>
                </div>

            <?php endforeach; ?>

        </div><br>

    <?php elseif (count($messages['success']) > 0) : ?>

        <div class="col-md-12 mb-5">

            <?php foreach ($messages['success'] as $success) : ?>

                <div class="alert alert-success fs-6 fst-italic fw-bold p-2 m-1" role="alert">
                    <?php echo $success; ?>
                </div>

            <?php endforeach; ?>

        </div><br>

<?php endif;
}

function _get_messages()
{
    return isset($_SESSION['messages']) ? $_SESSION['messages'] : ["errors" => [], "success" => [], "data" => []];
}

function validate_input($str)
{
    return htmlspecialchars(trim($str));
}

function _reset_messages_session(&$messages)
{
    if (isset($messages['success']) && count($messages['success']) > 0) {
        _set_session_val("messages", [
            "errors" => [],
            "success" => [],
            "data" => []
        ]);
    }

    if (isset($messages['errors']) && count($messages['errors']) > 0) {
        _set_session_val("messages", [
            "errors" => [],
            "success" => [],
            "data" => []
        ]);
    }

    if (isset($messages['data']) && count($messages['data']) > 0) {
        _set_session_val("messages", [
            "errors" => [],
            "success" => [],
            "data" => []
        ]);
    }
}

function _active_page($file_name)
{
    // _var_dump(basename($_SERVER['REQUEST_URI']));
    // _var_dump(basename("/"));
    return basename($_SERVER['REQUEST_URI']) === basename($file_name);
}
