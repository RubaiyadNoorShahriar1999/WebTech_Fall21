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

require_once _ROOT_DIR . "model/UserModel.php";

$user = _get_user(_get_session_val("email"));

?>

<?php header_section("EMS | View Profile"); ?>

    <main class="container p-2 my-3 border">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">View Profile</h1>
            </div>
        </div>
        <hr>
        <div class="row gx-5">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "8" : "12"; ?>">
                <ul class="list-group list-group-flush">

                    <?php if (isset($user['pp_path'])) : ?>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <img src="<?php echo !empty($user['pp_path']) ? _get_assets_uri($user['pp_path'], "uploads") : _get_assets_uri("default-pp.png", "img"); ?>" class="img-thumbnail rounded float-end" alt="<?php echo $user['name']; ?>">
                                </div>
                            </div>
                        </li>

                    <?php endif; ?>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3">
                                <spna class="text-dark">Name</spna>
                            </div>
                            <div class="col-md-9">
                                <span class="text-dark"><?php echo $user['name']; ?></span>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3">
                                <spna class="text-dark">Email</spna>
                            </div>
                            <div class="col-md-9">
                                <span class="text-dark"><?php echo $user['email']; ?></span>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3">
                                <spna class="text-dark">Gender</spna>
                            </div>
                            <div class="col-md-9">
                                <span class="text-dark"><?php echo ucfirst($user['gender']); ?></span>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3">
                                <spna class="text-dark">Death of Birth</spna>
                            </div>
                            <div class="col-md-9">
                                <span class="text-dark"><?php echo date("d/m/Y", strtotime($user['dob'])); ?></span>
                            </div>
                        </div>
                    </li>

                    <?php if (isset($user['degree']) && !empty($user['degree'])) : ?>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <spna class="text-dark">Degree</spna>
                                </div>
                                <div class="col-md-9">
                                    <span class="text-dark"><?php echo $user['degree']; ?></span>
                                </div>
                            </div>
                        </li>

                    <?php endif; ?>

                    <?php if (isset($user['institute']) && !empty($user['institute'])) : ?>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <spna class="text-dark">Institute</spna>
                                </div>
                                <div class="col-md-9">
                                    <span class="text-dark"><?php echo $user['institute']; ?></span>
                                </div>
                            </div>
                        </li>

                    <?php endif; ?>

                    <?php if (isset($user['specialization']) && !empty($user['specialization'])) : ?>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <spna class="text-dark">Specialization</spna>
                                </div>
                                <div class="col-md-9">
                                    <span class="text-dark"><?php echo $user['specialization']; ?></span>
                                </div>
                            </div>
                        </li>

                    <?php endif; ?>

                    <?php if (isset($user['work_area']) && !empty($user['work_area'])) : ?>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <spna class="text-dark">Work Area</spna>
                                </div>
                                <div class="col-md-9">
                                    <span class="text-dark"><?php echo $user['work_area']; ?></span>
                                </div>
                            </div>
                        </li>

                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </main>

<?php footer_section(); ?>