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

$messages = _get_messages();

// Reset the $messages

_reset_messages_session($messages);

?>

<?php header_section("EMS | Change Password"); ?>

    <main class="container p-2 my-3 border">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Change Password</h1>
            </div>
        </div>

        <hr>

        <div class="row gx-5">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "8" : "12"; ?>">
                <div class="row justify-content-center align-items-center">
                    <?php _print_messages($messages); ?>

                    <div class="col-md-12">
                        <form action="<?php echo _get_url("controller/ChangePasswordController.php"); ?>" method="POST">
                            <div class="mb-3 input-group">
                                <label for="currentpass" class="col-sm-4 col-form-label">Current Password</label>
                                <input type="password" name="currentpass" class="form-control mx-1" id="currentpass">
                            </div>
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
                                    <input class="btn btn-success" name="changepassword" type="submit" value="Change">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php footer_section(); ?>