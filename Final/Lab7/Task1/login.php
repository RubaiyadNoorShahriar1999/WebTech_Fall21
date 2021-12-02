<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(__FILE__) . "/helper/functions.php";

// Check login
if (_get_is_logged_in()) {
    header("Location: " . _get_url("dashboard/dashboard.php"));
    exit();
}

// _print_r($_SESSION);

header_section("EMS | Login Page");

?>

<main class="container py-2 my-3 border">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Login Page</h1>
        </div>
    </div>

    <hr>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-7">

            <?php _success_unsuccess_messages(); ?>

        </div>

        <div class="col-12 col-md-8 col-lg-7">
            <form id="login-form" action="<?php echo _get_url("controllers/LoginController.php"); ?>" method="post" class="needs-validation">
                <div class="row mb-3 has-validation">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">

                        <input id="email" type="text" name="email" class="form-control<?php echo _get_messages_css_class_name('email'); ?>" value="<?php echo _get_messages_data('email'); ?>" placeholder="sasuke@uchiha.com">

                        <?php if (_get_messages_errors('email')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('email'); ?></div><?php endif; ?>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">

                        <input id="password" type="password" name="password" class="form-control<?php echo _get_messages_css_class_name('password'); ?>" value="<?php echo _get_messages_data('password'); ?>">

                        <?php if (_get_messages_errors('password')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('password'); ?></div><?php endif; ?>

                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-3 pt-0">User Type</legend>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input id="doctor" type="radio" name="utype" class="form-check-input<?php echo _get_messages_data('utype') === "doctor" ? " is-valid" : ""; ?>" value="doctor" <?php echo _get_messages_data('utype') === "doctor" ? " checked" : ""; ?>>
                            <label class="form-check-label" for="doctor">Doctor</label>
                        </div>
                        <div class="form-check">
                            <input id="patient" type="radio" name="utype" class="form-check-input<?php echo _get_messages_data('utype') === "patient" ? " is-valid" : ""; ?>" value="patient" <?php echo _get_messages_data('utype') === "patient" ? " checked" : ""; ?>>
                            <label class="form-check-label" for="patient">Patient</label>
                        </div>
                        <div class="form-check">
                            <input id="admin" type="radio" name="utype" class="form-check-input<?php echo _get_messages_data('utype') === "admin" ? " is-valid" : ""; ?>" value="admin" <?php echo _get_messages_data('utype') === "admin" ? " checked" : ""; ?>>
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                        <div class="form-check">
                            <input id="emanager" type="radio" name="utype" class="form-check-input<?php echo _get_messages_data('utype') === "emanager" ? " is-valid" : ""; ?>" value="emanager" <?php echo _get_messages_data('utype') === "emanager" ? " checked" : ""; ?>>
                            <label class="form-check-label" for="emanager">Emergency Manager</label>
                        </div>

                        <input class="<?php echo trim(_get_messages_css_class_name('utype')); ?>" type="hidden">

                        <?php if (_get_messages_errors('utype')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('utype'); ?></div><?php endif; ?>

                    </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col-sm-9 offset-sm-3">
                        <div class="form-check">
                            <input id="rememberme" type="checkbox" name="rememberme" class="form-check-input<?php echo _get_messages_css_class_name('rememberme'); ?>" <?php echo _get_messages_data('rememberme') === "on" ? " checked" : ""; ?>>
                            <label class="form-check-label" for="rememberme">Remember Me</label>

                            <?php if (_get_messages_errors('rememberme')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('rememberme'); ?></div><?php endif; ?>

                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-9 offset-sm-3">
                        <button id="login-btn" type="submit" name="login" class="btn btn-success">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php footer_section(); ?>