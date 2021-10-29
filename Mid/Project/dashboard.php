<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>

<?php require_once dirname(__FILE__) . "/helper/functions.php"; ?>

<?php

if (!_get_is_logged_in()) {
    header("Location: login.php");
    exit();
}

?>

<?php header_section("EMS | Dashboard"); ?>

    <main class="container p-2 my-3 border">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Dashboard</h1>
            </div>
        </div>
        <hr>
        <div class="row gx-5">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "8" : "12"; ?>">
                <h1>Welcome <strong><?php echo _get_session_val('name'); ?></strong></h1>
            </div>
        </div>
    </main>

<?php footer_section(); ?>