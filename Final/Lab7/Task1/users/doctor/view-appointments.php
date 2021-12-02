<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>

<?php require_once dirname(dirname(dirname(__FILE__))) . "/helper/functions.php"; ?>

<?php

if (!_get_is_logged_in()) {
    header("Location: " . _get_url("login.php"));
    exit();
}

if (_get_session_val('utype') != "doctor") {
    header("Location: " . _get_url("dashboard/dashboard.php"));
    exit();
}

// $appointments = isset($messages['data']['appointments']) ? $messages['data']['appointments'] : [];

// if(!isset($messages['data']['appointments']) && empty($appointments)) {
//     // require_once _ROOT_DIR . "model/UserModel.php";

//     // $appointments = _view_appointments();
// }

?>

<?php header_section("EMS | View Appointments"); ?>

<main class="container py-2 my-3 border">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">View Appointments</h1>
        </div>
    </div>

    <hr>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="row">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "9" : "12"; ?>">

            </div>

        </div>
    </div>
</main>

<?php footer_section(); ?>

<!--
<div class="col-md-<?php echo _get_is_logged_in() ? "8" : "12"; ?>">
    <form action="<?php echo _get_url("controller/ViewAppointmentsController.php"); ?>" method="POST">
        <div class="row">
            <div class="col">
                <input type="text" name="patientemail" class="form-control" value="<?php echo isset($messages['data']['patientemail']) ? $messages['data']['patientemail'] : ""; ?>" placeholder="Patient Email..">
            </div>
            <div class="col">
                <input type="submit" name="viewappointments" class="form-control btn btn-success" value="Search">
            </div>
        </div>
    </form>
    <hr>
    <div class="d-flex justify-content-center align-items-center">
        <table class="table table-<?php echo _CONFIG['THEME_COLOR']; ?> table-striped">

            <?php if (count($appointments) > 0) : ?>

                <thead>
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

            <?php endif; ?>

            <tbody>

                <?php foreach ($appointments as $appointment) : ?>

                    <tr>
                        <td><?php echo $appointment; ?></td>
                        <td>
                            <a href="<?php echo _get_url("user/admin/delete-user.php?email=" . urlencode($appointment)); ?>" class="btn btn-success">Accept</a>
                            <a href="<?php echo _get_url("user/admin/delete-user.php?email=" . urlencode($appointment)); ?>" class="btn btn-danger">Reject</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

                <?php if (count($appointments) == 0) : ?>

                    <tr class="text-center">
                        <td colspan="6">No Appointment Found</td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>
-->