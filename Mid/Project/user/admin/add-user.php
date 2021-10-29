<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>

<?php require_once dirname(dirname(dirname(__FILE__))) . "/helper/functions.php"; ?>

<?php

if (!_get_is_logged_in()) {
    header("Location: ../../login.php");
    exit();
}

if (_get_session_val('utype') != "admin") {
    header("Location: ../../dashboard.php");
    exit();
}

$messages = _get_messages();

// Reset the $messages

_reset_messages_session($messages);

?>

<?php header_section("EMS | Add User"); ?>

    <main class="container p-2 my-3 border">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Add User</h1>
            </div>
        </div>
        <hr>

        <div class="row gx-3">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "8" : "12"; ?>">

                <?php _print_messages($messages); ?>

                <form action="<?php echo _get_url("controller/AddUserController.php"); ?>" method="POST">
                    <div class="mb-3 input-group">
                        <label for="name" class="col-sm-4 col-form-label">Name</label>
                        <input type="text" name="name" class="form-control mx-1" id="name" value="<?php echo isset($messages['data']['name']) ? $messages['data']['name'] : ""; ?>">
                    </div>
                    <div class="mb-3 input-group">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <input type="text" name="email" class="form-control mx-1" id="email" value="<?php echo isset($messages['data']['email']) ? $messages['data']['email'] : ""; ?>">
                    </div>
                    <div class="mb-3 input-group">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <input type="password" name="password" class="form-control mx-1" id="password" value="<?php echo isset($messages['data']['password']) ? $messages['data']['password'] : ""; ?>">
                    </div>
                    <div class="mb-3 input-group">
                        <label for="cpassword" class="col-sm-4 col-form-label">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control mx-1" id="cpassword" value="<?php echo isset($messages['data']['cpassword']) ? $messages['data']['cpassword'] : ""; ?>">
                    </div>
                    <div class="mb-3 input-group">
                        <label for="dob" class="col-sm-4 col-form-label">Date Of Birth</label>
                        <input type="date" name="dob" class="form-control mx-1" id="dob" value="<?php echo isset($messages['data']['dob']) ? $messages['data']['dob'] : ""; ?>">
                    </div>
                    <div class="mb-3 input-group">
                        <label for="male" class="col-sm-4 col-form-label">Gender</label>
                        <div class="form-group">
                            <input type="radio" name="gender" class="form-check-input" id="male" value="male" <?php echo isset($messages['data']['gender']) && $messages['data']['gender'] == "male" ? "checked" : ""; ?>>
                            <label for="male" class="form-check-label mx-1">Male</label>

                            <input type="radio" name="gender" class="form-check-input" id="female" value="female" <?php echo isset($messages['data']['gender']) && $messages['data']['gender'] == "female" ? "checked" : ""; ?>>
                            <label for="female" class="form-check-label mx-1">Female</label>

                            <input type="radio" name="gender" class="form-check-input" id="other" value="other" <?php echo isset($messages['data']['gender']) && $messages['data']['gender'] == "other" ? "checked" : ""; ?>>
                            <label for="other" class="form-check-label mx-1">Other</label>
                        </div>
                    </div>
                    <div class="mb-3 input-group">
                        <label for="doctor" class="col-sm-4 col-form-label">User Type</label>
                        <div class="form-group">
                            <input type="radio" name="utype" class="form-check-input" id="doctor" value="doctor" <?php echo isset($messages['data']['utype']) && $messages['data']['utype'] == "doctor" ? "checked" : ""; ?>>
                            <label for="doctor" class="form-check-label mx-1">Doctor</label>

                            <input type="radio" name="utype" class="form-check-input" id="patient" value="patient" <?php echo isset($messages['data']['utype']) && $messages['data']['utype'] == "patient" ? "checked" : ""; ?>>
                            <label for="patient" class="form-check-label mx-1">Patient</label>

                            <input type="radio" name="utype" class="form-check-input" id="edoctor" value="edoctor" <?php echo isset($messages['data']['utype']) && $messages['data']['utype'] == "edoctor" ? "checked" : ""; ?>>
                            <label for="edoctor" class="form-check-label mx-1">Emergency Manager</label>
                        </div>
                    </div>
                    <div class="row mb-3 input-group">
                        <div class="col-sm-4 text-end mx-auto">
                            <input class="btn btn-success" type="reset" value="Reset">
                        </div>
                        <div class="col-sm-8 text-start mx-auto">
                            <input class="btn btn-success" name="adduser" type="submit" value="Add user">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

<?php footer_section(); ?>