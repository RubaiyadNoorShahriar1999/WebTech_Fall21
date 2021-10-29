<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>

<?php require_once dirname(__FILE__) . "/helper/functions.php"; ?>

<?php

if (_get_is_logged_in()) {
    header("Location: dashboard.php");
    exit();
}

$messages = _get_messages();

// Reset the $messages

_reset_messages_session($messages);

?>

<?php header_section("EMS | Login Page"); ?>

    <main class="container p-2 my-3 border">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Login Page</h1>
            </div>
        </div>
        <hr>

        <div class="row justify-content-center align-items-center">

            <?php _print_messages($messages); ?>

            <div class="col-md-6">
                <form action="<?php echo _get_url("controller/LoginController.php"); ?>" method="POST">
                    <div class="mb-3 input-group">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <input type="text" name="email" class="form-control mx-1" id="email" value="<?php echo isset($messages['data']['email']) ? $messages['data']['email'] : ""; ?>">
                    </div>
                    <div class="mb-3 input-group">
                        <label for="password" class="col-sm-4 col-form-label">Password</label>
                        <input type="password" name="password" class="form-control mx-1" id="password" value="<?php echo isset($messages['data']['password']) ? $messages['data']['password'] : ""; ?>">
                    </div>
                    <div class="mb-3 input-group">
                        <label for="doctor" class="col-sm-4 col-form-label">User Type</label>
                        <div class="form-group">
                            <input type="radio" name="utype" class="form-check-input" id="doctor" value="doctor" <?php echo isset($messages['data']['utype']) && $messages['data']['utype'] == "doctor" ? "checked" : ""; ?>>
                            <label for="doctor" class="form-check-label mx-1">Doctor</label>

                            <input type="radio" name="utype" class="form-check-input" id="patient" value="patient" <?php echo isset($messages['data']['utype']) && $messages['data']['utype'] == "patient" ? "checked" : ""; ?>>
                            <label for="patient" class="form-check-label mx-1">Patient</label>

                            <br>

                            <input type="radio" name="utype" class="form-check-input" id="admin" value="admin" <?php echo isset($messages['data']['utype']) && $messages['data']['utype'] == "admin" ? "checked" : ""; ?>>
                            <label for="admin" class="form-check-label mx-1">Admin</label>

                            <input type="radio" name="utype" class="form-check-input" id="edoctor" value="edoctor" <?php echo isset($messages['data']['utype']) && $messages['data']['utype'] == "edoctor" ? "checked" : ""; ?>>
                            <label for="edoctor" class="form-check-label mx-1">Emergency Manager</label>
                        </div>
                    </div>
                    <div class="mb-3 input-group">
                        <label class="col-sm-4 col-form-label"></label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="rememberme" id="rememberme" <?php echo isset($messages['data']['rememberme']) && $messages['data']['rememberme'] == "on" ? "checked" : ""; ?>>
                            <label for="rememberme" class="form-check-label mx-1">Remember me</label>
                        </div>
                    </div>
                    <div class="row mb-3 input-group">
                        <div class="col-sm-4 text-end mx-auto">
                            <input class="btn btn-success" type="reset" value="Reset">
                        </div>
                        <div class="col-sm-3 text-start mx-auto">
                            <input class="btn btn-success" name="login" type="submit" value="Login">
                        </div>
                        <div class="col-sm-5 d-flex align-items-center text-start mx-auto">
                            <strong><a href="<?php echo _get_url("forget-password.php"); ?>" class="list-group-item d-inline text-<?php echo _CONFIG['THEME_COLOR']; ?> rounded p-1">Forget Password?</a></strong>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>

<?php footer_section(); ?>