<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>

<?php require_once dirname(dirname(dirname(__FILE__))) . "/helper/functions.php"; ?>

<?php

if (_get_is_logged_in()) {
    header("Location: ../../dashboard.php");
    exit();
} else {
    header("Location: ../../login.php");
    exit();
}
