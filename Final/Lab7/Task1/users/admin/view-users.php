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

// $users = isset($messages['data']['users']) ? $messages['data']['users'] : [];

// if(!isset($messages['data']['users']) && empty($users)) {
//     // require_once _ROOT_DIR . "model/UserModel.php";

//     // $users = _view_users();
// }

?>

<?php header_section("EMS | View Users"); ?>

<main class="container py-2 my-3 border">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">View Users</h1>
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
    <form action="<?php echo _get_url("controller/ViewUsersController.php"); ?>" method="POST">
        <div class="row">
            <div class="col">
                <input type="text" name="name" class="form-control" value="<?php echo isset($messages['data']['name']) ? $messages['data']['name'] : ""; ?>" placeholder="Name..">
            </div>
            <div class="col">
                <input type="text" name="email" class="form-control" value="<?php echo isset($messages['data']['email']) ? $messages['data']['email'] : ""; ?>" placeholder="Email..">
            </div>
            <div class="col">
                <input type="submit" name="viewusers" class="form-control btn btn-success" value="Search">
            </div>
        </div>
    </form>
    <hr>
    <div class="d-flex justify-content-center align-items-center">
        <table class="table table-<?php echo _CONFIG['THEME_COLOR']; ?> table-striped">

            <?php if (count($users) > 0) : ?>

                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Dob</th>
                        <th scope="col">Type</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

            <?php endif; ?>

            <tbody>

                <?php foreach ($users as $user) : ?>

                    <tr>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo ucfirst($user['gender']); ?></td>
                        <td><?php echo date("d/m/Y", strtotime($user['dob'])); ?></td>
                        <td><?php echo $user['utype']; ?></td>
                        <td>
                            <a href="<?php echo _get_url("user/admin/delete-user.php?email=" . urlencode($user['email'])); ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>

                <?php endforeach; ?>

                <?php if (count($users) == 0) : ?>

                    <tr class="text-center">
                        <td colspan="6">No Users Found</td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>
-->