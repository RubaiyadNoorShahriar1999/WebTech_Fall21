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

<?php header_section("EMS | Edit Profile"); ?>

    <main class="container p-2 my-3 border">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Edit Profile</h1>
            </div>
        </div>

        <hr>

        <div class="row gx-5">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "8" : "12"; ?>">
                <div class="row justify-content-center align-items-center">
                    <?php _print_messages($messages); ?>

                    <div class="col-md-12">
                        <form action="<?php echo _get_url("controller/EditProfileController.php"); ?>" method="POST">
                            <div class="mb-3 input-group">
                                <label for="name" class="col-sm-4 col-form-label">Name</label>
                                <input type="text" name="name" class="form-control mx-1" id="name" value="<?php echo _get_session_val("name"); ?>">
                            </div>
                            <div class="mb-3 input-group">
                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                <input type="text" name="email" class="form-control mx-1" id="email" value="<?php echo _get_session_val("email"); ?>">
                            </div>
                            <div class="mb-3 input-group">
                                <label for="dob" class="col-sm-4 col-form-label">Date Of Birth</label>
                                <input type="date" name="dob" class="form-control mx-1" id="dob" value="<?php echo _get_session_val("dob"); ?>">
                            </div>
                            <div class="mb-3 input-group">
                                <label for="male" class="col-sm-4 col-form-label">Gender</label>
                                <div class="form-group">
                                    <input type="radio" name="gender" class="form-check-input" id="male" value="male" <?php echo _get_session_val("gender") == "male" ? "checked" : ""; ?>>
                                    <label for="male" class="form-check-label mx-1">Male</label>

                                    <input type="radio" name="gender" class="form-check-input" id="female" value="female" <?php echo _get_session_val("gender") == "female" ? "checked" : ""; ?>>
                                    <label for="female" class="form-check-label mx-1">Female</label>

                                    <input type="radio" name="gender" class="form-check-input" id="other" value="other" <?php echo _get_session_val("gender") == "other" ? "checked" : ""; ?>>
                                    <label for="other" class="form-check-label mx-1">Other</label>
                                </div>
                            </div>

                            <?php if (preg_match("/(doctor|edoctor)/", _get_session_val("utype")) == 1) : ?>

                                <div class="mb-3 input-group">
                                    <label for="degree" class="col-sm-4 col-form-label">Degree</label>
                                    <input type="text" name="degree" class="form-control mx-1" id="degree" value="<?php echo _get_session_val("degree"); ?>">
                                </div>

                            <?php endif; ?>

                            <?php if (preg_match("/(doctor|edoctor)/", _get_session_val("utype")) == 1) : ?>

                                <div class="mb-3 input-group">
                                    <label for="institute" class="col-sm-4 col-form-label">Institute</label>
                                    <input type="text" name="institute" class="form-control mx-1" id="institute" value="<?php echo _get_session_val("institute"); ?>">
                                </div>

                            <?php endif; ?>

                            <?php if (preg_match("/(doctor|edoctor)/", _get_session_val("utype")) == 1) : ?>

                                <div class="mb-3 input-group">
                                    <label for="specialization" class="col-sm-4 col-form-label">Specialization</label>
                                    <input type="text" name="specialization" class="form-control mx-1" id="specialization" value="<?php echo _get_session_val("specialization"); ?>">
                                </div>

                            <?php endif; ?>

                            <?php if (_get_session_val("utype") == "edoctor") : ?>

                                <div class="mb-3 input-group">
                                    <label for="work_area" class="col-sm-4 col-form-label">Work Area</label>
                                    <input type="text" name="work_area" class="form-control mx-1" id="work_area" value="<?php echo _get_session_val("work_area"); ?>">
                                </div>

                            <?php endif; ?>

                            <div class="row mb-3 input-group">
                                <div class="col-sm-4 text-end mx-auto"></div>
                                <div class="col-sm-8 text-start mx-auto">
                                    <input class="btn btn-success" name="editprofile" type="submit" value="Save">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php footer_section(); ?>