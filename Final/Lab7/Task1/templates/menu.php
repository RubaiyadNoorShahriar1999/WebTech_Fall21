<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");

// _var_dump(_active_page($_SERVER['REQUEST_URI']) ? " active" : "");

$login_primary_menus = [
    [
        "title"     => "Dashboard",
        "path"      => "dashboard/dashboard.php",
    ],
    [
        "title"     => "View Profile",
        "path"      => "dashboard/view-profile.php",
    ],
    [
        "title"     => "Edit Profile",
        "path"      => "dashboard/edit-profile.php",
    ],
    [
        "title"     => "Profile Picture",
        "path"      => "dashboard/change-pp.php",
    ],
    [
        "title"     => "Change Password",
        "path"      => "dashboard/change-password.php",
    ],
    [
        "title"     => "Logout",
        "path"      => "logout.php",
    ],
];

$non_login_primary_menus = [
    [
        "title"     => "Home",
        "path"      => "index.php",
    ],
    [
        "title"     => "About",
        "path"      => "about.php",
    ],
    [
        "title"     => "Login",
        "path"      => "login.php",
    ],
    [
        "title"     => "Registration",
        "path"      => "registration.php",
    ],
];

$admin_menus = [
    [
        "title"     => "Verify Doctor",
        "path"      => "users/admin/verify-doctor.php",
    ],
    [
        "title"     => "View Users",
        "path"      => "users/admin/view-users.php",
    ],
    [
        "title"     => "Add User",
        "path"      => "users/admin/add-user.php",
    ],
    // [
    //     "title"     => "Edit User",
    //     "path"      => "users/admin/edit-user.php",
    // ],
    // [
    //     "title"     => "Delete User",
    //     "path"      => "users/admin/delete-user.php",
    // ],
];

$doctor_menus = [
    [
        "title"     => "View Appointments",
        "path"      => "users/doctor/view-appointments.php",
    ],
    [
        "title"     => "Add Scheduled",
        "path"      => "users/doctor/add-scheduled.php",
    ],
    [
        "title"     => "Edit Scheduled",
        "path"      => "users/doctor/edit-scheduled.php",
    ],
    [
        "title"     => "Delete Scheduled",
        "path"      => "users/doctor/delete-scheduled.php",
    ],
    [
        "title"     => "Appointments History",
        "path"      => "users/doctor/appointments-history.php",
    ],
];

$emanager_menus = [
    [
        "title"     => "Add Ambulance",
        "path"      => "users/emanager/add-ambulance.php",
    ],
    // [
    //     "title"     => "Edit Ambulance",
    //     "path"      => "users/emanager/edit-ambulance.php",
    // ],
    // [
    //     "title"     => "Delete Ambulance",
    //     "path"      => "users/emanager/delete-ambulance.php",
    // ],
    [
        "title"     => "View Ambulances",
        "path"      => "users/emanager/view-ambulances.php",
    ],
    [
        "title"     => "Add Hospital",
        "path"      => "users/emanager/add-hospital.php",
    ],
    // [
    //     "title"     => "Edit Hospital",
    //     "path"      => "users/emanager/edit-hospital.php",
    // ],
    // [
    //     "title"     => "Delete Hospital",
    //     "path"      => "users/emanager/delete-hospital.php",
    // ],
    [
        "title"     => "View Hospitals",
        "path"      => "users/emanager/view-hospitals.php",
    ],
];

$patient_menus = [
    [
        "title"     => "Request Appointment",
        "path"      => "users/patient/request-appointment.php",
    ],
    [
        "title"     => "Request Ambulance",
        "path"      => "users/patient/request-ambulance.php",
    ],
    [
        "title"     => "Request Emergency Doctor",
        "path"      => "users/patient/request-edoctor.php",
    ],
    [
        "title"     => "View Doctors",
        "path"      => "users/patient/view-doctors.php",
    ],
    [
        "title"     => "View Hospitals",
        "path"      => "users/patient/view-hospitals.php",
    ],
];

?>
<?php function primary_menu()
{ ?>

    <ul class="nav d-flex flex-column w-100 h-100 <?php echo _get_is_logged_in() ? "flex-lg-row justify-content-lg-end align-items-lg-center" : "flex-md-row justify-content-md-end align-items-md-center"; ?>">

        <?php if (_get_is_logged_in()) : global $login_primary_menus; ?>

            <?php foreach ($login_primary_menus as $menu) : ?>

                <li class="list-group m-1">
                    <a class="nav-link list-group-item text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page(basename($menu['path'])) ? " active text-white" : ""; ?>" href="<?php echo _get_url($menu['path']); ?>"><?php echo $menu['title']; ?></a>
                </li>

            <?php endforeach; ?>

        <?php else : global $non_login_primary_menus; ?>

            <?php foreach ($non_login_primary_menus as $menu) : ?>

                <li class="list-group m-1">
                    <a class="nav-link list-group-item text-<?php echo _CONFIG["THEME_COLOR"]; ?> rounded<?php echo _active_page($menu['path']) ? " active text-white" : ""; ?>" href="<?php echo _get_url($menu['path']); ?>"><?php echo $menu['title']; ?></a>
                </li>

            <?php endforeach; ?>

        <?php endif; ?>

    </ul>

<?php } ?>


<?php function side_menu()
{ ?>

    <div class="col-12 col-md-3">

        <button class="d-block d-md-none btn btn-<?php echo _CONFIG['THEME_COLOR']; ?> mb-3 w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesidemenu" aria-expanded="false" aria-controls="collapsesidemenu"><i class="bi bi-list"></i></button>

        <div id="collapsesidemenu" class="collapse animate-100 d-md-block list-group mb-3">

            <?php if (_get_session_val('utype') == 'admin') : global $admin_menus; ?>

                <?php foreach ($admin_menus as $menu) : ?>

                    <a href="<?php echo _get_url($menu['path']); ?>" class="list-group-item list-group-item-action<?php echo _active_page(basename($menu['path'])) ? " active" : ""; ?>"><?php echo $menu['title']; ?></a>

                <?php endforeach; ?>

            <?php elseif (_get_session_val('utype') == 'doctor') : global $doctor_menus; ?>

                <?php foreach ($doctor_menus as $menu) : ?>

                    <a href="<?php echo _get_url($menu['path']); ?>" class="list-group-item list-group-item-action<?php echo _active_page(basename($menu['path'])) ? " active" : ""; ?>"><?php echo $menu['title']; ?></a>

                <?php endforeach; ?>

            <?php elseif (_get_session_val('utype') == 'emanager') : global $emanager_menus; ?>

                <?php foreach ($emanager_menus as $menu) : ?>

                    <a href="<?php echo _get_url($menu['path']); ?>" class="list-group-item list-group-item-action<?php echo _active_page(basename($menu['path'])) ? " active" : ""; ?>"><?php echo $menu['title']; ?></a>

                <?php endforeach; ?>

            <?php elseif (_get_session_val('utype') == 'patient') : global $patient_menus; ?>

                <?php foreach ($patient_menus as $menu) : ?>

                    <a href="<?php echo _get_url($menu['path']); ?>" class="list-group-item list-group-item-action<?php echo _active_page(basename($menu['path'])) ? " active" : ""; ?>"><?php echo $menu['title']; ?></a>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </div>

<?php } ?>