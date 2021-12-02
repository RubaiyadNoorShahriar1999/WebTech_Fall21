<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>

<?php require_once dirname(__FILE__, 3) . "/helper/functions.php"; ?>

<?php

if (!_get_is_logged_in()) {
    header("Location: " . _get_url("login.php"));
    exit();
}

if (_get_session_val('utype') != "admin") {
    header("Location: " . _get_url("dashboard/index.php"));
    exit();
}

?>

<?php header_section("EMS | Delete User"); ?>

<main class="container py-2 my-3 border">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Delete User</h1>
        </div>
    </div>

    <hr>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="row">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "9" : "12"; ?>">

            </div>

            <!--
            <form action="<?php echo _get_url("controller/DeleteUserController.php"); ?>" method="POST" id="deleteuserform">
                <div class="row">
                    <div class="col">
                        <input type="text" name="email" class="form-control" value="<?php echo isset($messages['data']['email']) ? $messages['data']['email'] : (isset($_GET['email']) ? $_GET['email'] : ""); ?>" placeholder="Email..">
                    </div>
                    <div class="col">
                        <input name="deleteuser" class="form-control btn btn-danger" id="deleteuser" value="Delete">
                    </div>
                </div>
            </form>
            -->

        </div>
    </div>
</main>

<?php footer_section(); ?>