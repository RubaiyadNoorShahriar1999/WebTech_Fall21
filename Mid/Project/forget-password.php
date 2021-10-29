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

if (_get_session_val('forget_pass') != null && _get_session_val('foget_pass_email') != null) {
    header("Location: change-forget-password.php");
    exit();
}

$messages = _get_messages();

// Reset the $messages

_reset_messages_session($messages);

?>

<?php header_section("EMS | Forget Password"); ?>

    <main class="container p-2 my-3 border">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Forget Password</h1>
            </div>
        </div>

        <hr>

        <div class="row gx-5">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "8" : "12"; ?>">
                <div class="row justify-content-center align-items-center">
                    <?php _print_messages($messages); ?>

                    <div class="col-md-8">
                        <form action="<?php echo _get_url("controller/ForgetPasswordController.php"); ?>" method="POST">
                            <div class="mb-3 input-group">
                                <label for="email" class="col-sm-4 col-form-label text-center">Email</label>
                                <input type="text" name="email" class="form-control mx-1" id="email">
                            </div>

                            <div class="row mb-3 input-group">
                                <div class="col-sm-4 text-end mx-auto"></div>
                                <div class="col-sm-8 text-start mx-auto">
                                    <input class="btn btn-success" name="forgetpass" type="submit" value="Request">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php footer_section(); ?>