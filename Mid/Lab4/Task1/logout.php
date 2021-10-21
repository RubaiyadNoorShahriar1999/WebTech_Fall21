<?php

/**
 * @link https://www.php.net/session_destroy#refsect1-function.session-destroy-examples
 */

// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {

    // echo '<pre>';
    // var_dump(session_name());
    // echo '</pre>';
    // return;

    // 60 * 60 * 24 * 7 = 7 days
    $exprire = 60 * 60 * 24 * 7;

    setcookie('username', '', time() - $exprire);
    setcookie('email', '', time() - $exprire);
}

// Finally, destroy the session.
session_destroy();

// Return to login page
header("Location: login.php");
