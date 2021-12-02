<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(__FILE__) . "/helper/functions.php";


// var_dump(basename(dirname(__FILE__, 2)));
// return;

header_section("EMS");

?>

<main class="container py-2 my-3 border">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Welcome to <strong>24/7 Emergency Services</strong></h1>
        </div>
    </div>
    <hr>
    <div class="row d-flex justify-content-center align-items-center">
        <div class="row">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "9" : "12"; ?>">
                <p>
                    This System is about an Online Emergency Service.We have patients, emergency doctors, admins, hospitals, ambulance and Emergency service manager. Our service will be 24/7 service.Our special feature is Emergency Doctor Service here emergency doctor will be assigned by their area.The whole project is online based.This system is more applicable for current pandemic situation. People can get help easily on their emergency medical need.
                </p>
            </div>
        </div>
    </div>
</main>

<?php footer_section(); ?>