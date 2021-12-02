<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>

<?php require_once dirname(__FILE__, 2) . "/helper/functions.php"; ?>

<?php

if (_get_is_logged_in()) {
    header("Location: " . _get_url("dashboard/dashboard.php"));
    exit();
} else {
    header("Location: " . _get_url("login.php"));
    exit();
}
