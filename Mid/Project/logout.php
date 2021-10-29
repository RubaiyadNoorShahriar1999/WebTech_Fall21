<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

/**
 * @link https://www.php.net/session_destroy#refsect1-function.session-destroy-examples
 */

require_once dirname(__FILE__) . "/helper/functions.php";;

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();

    setcookie('email', '', time() - _CONFIG['EXPIRED'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    setcookie('utype', '', time() - _CONFIG['EXPIRED'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}

// Finally, destroy the session.
session_destroy();

// Return to login page
header("Location: login.php");
