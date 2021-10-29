<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>

<?php require_once dirname(__FILE__) . "/helper/functions.php"; ?>

<?php

if (_get_is_logged_in()) {
    header("Location: change-password.php");
    exit();
}

if (_get_session_val('forget_pass') == null || _get_session_val('foget_pass_email') == null) {
    header("Location: forget-password.php");
    exit();
}
// _set_session_val("forget_pass", null);
// _var_dump($_SESSION);

$messages = _get_messages();

if (isset($messages['success']) && count($messages['success']) > 0) {

    session_reset();
    session_unset();
    session_destroy();
}

// _var_dump($_SESSION);

// Reset the $messages

_reset_messages_session($messages);

?>

<?php header_section("EMS | Change Password"); ?>

    <main class="container p-2 my-3 border">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Change Password <strong class="fs-6">(<?php echo _get_session_val('foget_pass_email'); ?>)</strong></h1>
            </div>
        </div>

        <hr>

        <div class="row gx-5">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "8" : "12"; ?>">
                <div class="row justify-content-center align-items-center">
                    <?php _print_messages($messages); ?>

                    <div class="col-md-12">
                        <form action="<?php echo _get_url("controller/ChangeForgetPasswordController.php"); ?>" method="POST">
                            <div class="mb-3 input-group">
                                <label for="newpass" class="col-sm-4 col-form-label">New Password</label>
                                <input type="password" name="newpass" class="form-control mx-1" id="newpass">
                            </div>
                            <div class="mb-3 input-group">
                                <label for="retypepass" class="col-sm-4 col-form-label">Retype Password</label>
                                <input type="password" name="retypepass" class="form-control mx-1" id="retypepass">
                            </div>

                            <div class="row mb-3 input-group">
                                <div class="col-sm-4 text-end mx-auto"></div>
                                <div class="col-sm-8 text-start mx-auto">
                                    <input class="btn btn-success" name="changeforgetpass" type="submit" value="Change">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php footer_section(); ?>