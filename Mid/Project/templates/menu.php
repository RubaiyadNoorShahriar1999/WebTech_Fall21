<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");

// _var_dump(_active_page($_SERVER['REQUEST_URI']) ? " active" : "");

?>
<?php function primary_menu() { ?>

    <ul class="nav d-flex h-100 justify-content-end align-items-center">

        <?php if (_get_is_logged_in()) : ?>

            <li class="list-group m-1">
                <a class="nav-link list-group-item d-inline text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page("dashboard.php") ? " active text-white" : ""; ?>" href="<?php echo _get_url("dashboard.php"); ?>">Dashboard</a>
            </li>
            <li class="list-group m-1">
                <a class="nav-link list-group-item d-inline text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page("view-profile.php") ? " active text-white" : ""; ?>" href="<?php echo _get_url("view-profile.php"); ?>">View Profile</a>
            </li>
            <li class="list-group m-1">
                <a class="nav-link list-group-item d-inline text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page("edit-profile.php") ? " active text-white" : ""; ?>" href="<?php echo _get_url("edit-profile.php"); ?>">Edit Profile</a>
            </li>
            <li class="list-group m-1">
                <a class="nav-link list-group-item d-inline text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page("change-pp.php") ? " active text-white" : ""; ?>" href="<?php echo _get_url("change-pp.php"); ?>">Profile Picture</a>
            </li>
            <li class="list-group m-1">
                <a class="nav-link list-group-item d-inline text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page("change-password.php") ? " active text-white" : ""; ?>" href="<?php echo _get_url("change-password.php"); ?>">Change Password</a>
            </li>
            <li class="list-group m-1">
                <a class="nav-link list-group-item d-inline text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page("logout.php") ? " active text-white" : ""; ?>" href="<?php echo _get_url("logout.php"); ?>">Logout</a>
            </li>

        <?php else : ?>

            <li class="list-group m-1">
                <a class="nav-link list-group-item d-inline text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page("index.php") ? " active text-white" : ""; ?>" href="<?php echo _get_url("index.php"); ?>">Home</a>
            </li>
            <li class="list-group m-1">
                <a class="nav-link list-group-item d-inline text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page("about.php") ? " active text-white" : ""; ?>" href="<?php echo _get_url("about.php"); ?>">About</a>
            </li>
            <li class="list-group m-1">
                <a class="nav-link list-group-item d-inline text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page("login.php") ? " active text-white" : ""; ?>" href="<?php echo _get_url("login.php"); ?>">Login</a>
            </li>
            <li class="list-group m-1">
                <a class="nav-link list-group-item d-inline text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page("registration.php") ? " active text-white" : ""; ?>" href="<?php echo _get_url("registration.php"); ?>">Registration</a>
            </li>

        <?php endif; ?>

    </ul>

<?php } ?>


<?php function side_menu() { ?>

    <div class="col-md-3">
        <div class="list-group">

            <?php if (_get_session_val('utype') == 'admin') : ?>
                
                <a href="<?php echo _get_url("user/admin/view-users.php"); ?>" class="list-group-item list-group-item-action<?php echo _active_page("view-users.php") ? " active" : ""; ?>">View Users</a>
                
                <a href="<?php echo _get_url("user/admin/delete-user.php"); ?>" class="list-group-item list-group-item-action<?php echo _active_page("delete-user.php") ? " active" : ""; ?>">Delete User</a>
                

                <a href="<?php echo _get_url("user/admin/add-user.php"); ?>" class="list-group-item list-group-item-action<?php echo _active_page("add-user.php") ? " active" : ""; ?>">Add User</a>

                <a href="<?php echo _get_url("#"); ?>" class="list-group-item list-group-item-action">Edit User</a>
                <a href="<?php echo _get_url("#"); ?>" class="list-group-item list-group-item-action">Verify Doctor</a>
                <a href="<?php echo _get_url("#"); ?>" class="list-group-item list-group-item-action">Verify User</a>

            <?php elseif (_get_session_val('utype') == 'doctor') : ?>

                <a href="<?php echo _get_url("user/doctor/view-appointment-list.php"); ?>" class="list-group-item list-group-item-action<?php echo _active_page("view-appointment-list.php") ? " active" : ""; ?>">View Appointment List</a>

            <?php elseif (_get_session_val('utype') == 'patient') : ?>

                <a href="<?php echo _get_url("user/patient/appointment.php"); ?>" class="list-group-item list-group-item-action<?php echo _active_page("appointment.php") ? " active" : ""; ?>">Appointment</a>


                <a href="<?php echo _get_url("user/patient/ambulance.php"); ?>" class="list-group-item list-group-item-action<?php echo _active_page("ambulance.php") ? " active" : ""; ?>">Requested Ambulance</a>

            <?php endif; ?>

        </div>
    </div>

<?php } ?>