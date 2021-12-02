<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(__FILE__) . "/helper/functions.php";

// _print_r(_get_messages_data('password'));
// _var_dump(password_verify("asd@#123", _get_messages_data('password')));

header_section("EMS | Registration Page");
?>

<main class="container py-2 my-3 border">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Registration Page</h1>
        </div>
    </div>

    <hr>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-7">

            <?php _success_unsuccess_messages(); ?>

        </div>

        <div class="col-12 col-md-8 col-lg-7">
            <form id="registration-form" action="<?php echo _get_url("controllers/RegistrationController.php"); ?>" method="post" class="needs-validation">
                <div class="row mb-3 has-validation">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input id="name" type="text" name="name" class="form-control<?php echo _get_messages_css_class_name('name'); ?>" value="<?php echo _get_messages_data('name'); ?>" placeholder="Sasuke Uchiha">

                        <?php if (_get_messages_errors('name')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('name'); ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="row mb-3 has-validation">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input id="email" type="text" name="email" class="form-control<?php echo _get_messages_css_class_name('email'); ?>" value="<?php echo _get_messages_data('email'); ?>" placeholder="sasuke@uchiha.com">

                        <?php if (_get_messages_errors('email')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('email'); ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="row mb-3 has-validation">
                    <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-9">
                        <input id="phone" type="text" name="phone" class="form-control<?php echo _get_messages_css_class_name('phone'); ?>" value="<?php echo _get_messages_data('phone'); ?>" placeholder="+88016xxxxxxxx">

                        <?php if (_get_messages_errors('phone')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('phone'); ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="row mb-3 has-validation">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input id="password" type="password" name="password" class="form-control<?php echo _get_messages_css_class_name('password'); ?>" value="<?php echo _get_messages_data('password'); ?>">

                        <?php if (_get_messages_errors('password')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('password'); ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="row mb-3 has-validation">
                    <label for="cpassword" class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                        <input id="cpassword" type="password" name="cpassword" class="form-control<?php echo _get_messages_css_class_name('cpassword'); ?>" value="<?php echo _get_messages_data('cpassword'); ?>">

                        <?php if (_get_messages_errors('cpassword')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('cpassword'); ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="row mb-3 has-validation">
                    <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                    <div class="col-sm-9">
                        <input id="dob" type="date" name="dob" class="form-control<?php echo _get_messages_css_class_name('dob'); ?>" value="<?php echo _get_messages_data('dob'); ?>">

                        <?php if (_get_messages_errors('dob')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('dob'); ?></div><?php endif; ?>
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-3 pt-0">Gender</legend>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input id="male" type="radio" name="gender" class="form-check-input<?php echo _get_messages_data('gender') === "male" ? " is-valid" : ""; ?>" value="male" <?php echo _get_messages_data('gender') === "male" ? " checked" : ""; ?>>
                            <label for="male" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input id="female" type="radio" name="gender" class="form-check-input<?php echo _get_messages_data('gender') === "female" ? " is-valid" : ""; ?>" value="female" <?php echo _get_messages_data('gender') === "female" ? " checked" : ""; ?>>
                            <label for="female" class="form-check-label">Female</label>
                        </div>
                        <div class="form-check">
                            <input id="other" type="radio" name="gender" class="form-check-input<?php echo _get_messages_data('gender') === "other" ? " is-valid" : ""; ?>" value="other" <?php echo _get_messages_data('gender') === "other" ? " checked" : ""; ?>>
                            <label for="other" class="form-check-label">Other</label>
                        </div>

                        <input class="<?php echo trim(_get_messages_css_class_name('gender')); ?>" type="hidden">

                        <?php if (_get_messages_errors('gender')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('gender'); ?></div><?php endif; ?>

                    </div>
                </fieldset>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-3 pt-0">User Type</legend>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input id="doctor" type="radio" name="utype" class="form-check-input<?php echo _get_messages_data('utype') === "doctor" ? " is-valid" : ""; ?>" value="doctor" <?php echo _get_messages_data('utype') === "doctor" ? " checked" : ""; ?>>
                            <label for="doctor" class="form-check-label">Doctor</label>
                        </div>
                        <div class="form-check">
                            <input id="patient" type="radio" name="utype" class="form-check-input<?php echo _get_messages_data('utype') === "patient" ? " is-valid" : ""; ?>" value="patient" <?php echo _get_messages_data('utype') === "patient" ? " checked" : ""; ?>>
                            <label for="patient" class="form-check-label">Patient</label>
                        </div>
                        <div class="form-check">
                            <input id="admin" type="radio" name="utype" class="form-check-input<?php echo _get_messages_data('utype') === "admin" ? " is-valid" : ""; ?>" value="admin" <?php echo _get_messages_data('utype') === "admin" ? " checked" : ""; ?>>
                            <label for="admin" class="form-check-label">Admin</label>
                        </div>
                        <div class="form-check">
                            <input id="emanager" type="radio" name="utype" class="form-check-input<?php echo _get_messages_data('utype') === "emanager" ? " is-valid" : ""; ?>" value="emanager" <?php echo _get_messages_data('utype') === "emanager" ? " checked" : ""; ?>>
                            <label for="emanager" class="form-check-label">Emergency Manager</label>
                        </div>

                        <input class="<?php echo trim(_get_messages_css_class_name('utype')); ?>" type="hidden">

                        <?php if (_get_messages_errors('utype')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('utype'); ?></div><?php endif; ?>

                    </div>
                </fieldset>
                <div class="row mb-3 has-validation">
                    <div class="col-sm-9 offset-sm-3">
                        <div class="form-check">
                            <input id="privacy" type="checkbox" name="privacy" class="form-check-input<?php echo _get_messages_css_class_name('privacy'); ?>" <?php echo _get_messages_data('privacy') === "on" ? " checked" : ""; ?>>
                            <label for="privacy" class="form-check-label"><a href="" target="_blank" class="link-primary">Terms and Conditions</a></label>

                            <?php if (_get_messages_errors('privacy')) : ?><div class="invalid-feedback"><?php echo _get_messages_errors('privacy'); ?></div><?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 has-validation">
                    <div class="col-sm-3 mb-3 text-sm-end">
                        <button id="reset-btn" type="reset" class="btn btn-success">Reset</button>
                    </div>
                    <div class="col-sm-3 mb-3 text-sm-start">
                        <button id="registration-btn" type="submit" name="registration" class="btn btn-success">Registration</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php footer_section(); ?>