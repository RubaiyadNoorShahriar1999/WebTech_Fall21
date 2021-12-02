<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>

<?php require_once dirname(dirname(dirname(__FILE__))) . "/helper/functions.php"; ?>

<?php

if (!_get_is_logged_in()) {
    header("Location: " . _get_url("login.php"));
    exit();
}

if (_get_session_val('utype') != "patient") {
    header("Location: " . _get_url("dashboard/dashboard.php"));
    exit();
}

?>

<?php header_section("EMS | Request Appointment"); ?>

<main class="container py-2 my-3 border">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Request Appointment</h1>
        </div>
    </div>

    <hr>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="row">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "9" : "12"; ?>">

            </div>

        </div>
    </div>
</main>

<?php footer_section(); ?>

<!--
<div class="col-md-<?php echo _get_is_logged_in() ? "8" : "12"; ?>">
    <form action="<?php echo _get_url("controller/AppointmentController.php"); ?>" method="POST">
        <div class="mb-3 input-group">
            <label for="docemail" class="col-sm-4 col-form-label">Doctor Email</label>
            <input type="text" name="docemail" class="form-control mx-1" id="docemail" value="<?php echo isset($messages['data']['docemail']) ? $messages['data']['docemail'] : ""; ?>">
        </div>
        <div class="row mb-3 input-group">
            <div class="col-sm-4 text-end mx-auto">
                <input class="btn btn-success" type="reset" value="Reset">
            </div>
            <div class="col-sm-8 text-start mx-auto">
                <input class="btn btn-success" name="appointment" type="submit" value="Request Appointment">
            </div>
        </div>
    </form>
</div>
-->