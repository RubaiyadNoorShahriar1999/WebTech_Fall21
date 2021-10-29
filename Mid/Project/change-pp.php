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

<?php header_section("EMS | Change Profile Picture"); ?>

    <main class="container p-2 my-3 border">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Change Profile Picture</h1>
            </div>
        </div>

        <hr>

        <div class="row gx-5">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "8" : "12"; ?>">
                <div class="row justify-content-center align-items-center">
                    <?php _print_messages($messages); ?>

                    <div class="col-md-12">
                        <form action="<?php echo _get_url("controller/ChangeProfilePictureController.php"); ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 input-group">
                                <label for="picture" class="col-sm-4 col-form-label"></label>
                                <div class="form-control d-flex justify-content-center align-item-center border-0 mx-1">
                                    <img src="<?php echo !empty(_get_session_val('pp_path')) ? _get_assets_uri(_get_session_val('pp_path'), "uploads") : _get_assets_uri("default-pp.png", "img"); ?>" class="img-thumbnail rounded" alt="<?php echo _get_session_val("name");   ?>">
                                </div>
                            </div>
                            <div class="mb-3 input-group">
                                <label for="picture" class="col-sm-4 col-form-label">Picture</label>
                                <input type="file" name="picture" class="form-control mx-1" id="picture">
                            </div>
                            <div class="row mb-3 input-group">
                                <div class="col-sm-4 text-end mx-auto"></div>
                                <div class="col-sm-8 text-start mx-auto">
                                    <input class="btn btn-success" name="changepp" type="submit" value="Upload">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php footer_section(); ?>