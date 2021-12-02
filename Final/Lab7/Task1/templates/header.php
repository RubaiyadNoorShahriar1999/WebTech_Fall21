<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");

// _var_dump($_SESSION);

?>
<?php function header_section(string $title = "Document")
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo _get_assets_uri("favicon.ico", "img"); ?>" type="image/x-icon">

        <!-- Bootstrap -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha256-YvdLHPgkqJ8DVUxjjnGVlMMJtNimJ6dYkowFFvp4kKs=" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css" crossorigin="anonymous"> -->

        <link rel="stylesheet" href="<?php echo _get_assets_uri("bootstrap.min.css", "css"); ?>">
        <link rel="stylesheet" href="<?php echo _get_assets_uri("bootstrap-icons.css", "css"); ?>">

        <!-- My custom css -->
        <link rel="stylesheet" href="<?php echo _get_assets_uri("style.css", "css"); ?>">
    </head>

    <body>
        <i id="dark_mode_1" class="btn btn-success shadow rounded-pill bi bi-lightbulb-fill text-dark"></i>
        <header class="d-none <?php echo _get_is_logged_in() ? "d-lg-block" : "d-md-block"; ?> container bg-<?php echo _CONFIG["THEME_COLOR"]; ?> p-3">
            <div class="row">
                <div class="col-12 col-md-3 text-center text-md-start">
                    <a href="<?php echo _get_url("index.php"); ?>" class="navbar-brand-md h2 text-decoration-none text-white"><i class="bi bi-life-preserver text-white display-5"></i></a>
                    <?php if (_get_is_logged_in()) : ?>

                        <div>
                            <span class="text-white fs-6">Logged in as <a href="<?php echo _get_url("dashboard/view-profile.php"); ?>" class="list-group-item d-inline text-<?php echo _CONFIG['THEME_COLOR']; ?> rounded p-1"><?php echo ucfirst(strtok(_get_session_val("name"), " ")); ?></a></span>
                        </div>

                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-9 d-flex justify-content-center align-items-center">

                    <?php primary_menu(); ?>

                </div>
            </div>
        </header>

        <header class="<?php echo _get_is_logged_in() ? "d-lg-none" : "d-md-none"; ?> container bg-<?php echo _CONFIG["THEME_COLOR"]; ?> p-3">
            <div class="row d-flex justify-content-between">
                <div class="col text-start">
                    <button class="btn btn-success align-baseline" type="button" data-bs-toggle="offcanvas" data-bs-target="#canvasmenu" aria-controls="canvasmenu"><i class="bi bi-list"></i></button>
                </div>
                <div class="col text-end">
                    <i id="dark_mode_2" class="btn btn-success shadow rounded-pill bi bi-lightbulb-fill text-dark"></i>
                </div>
            </div>
            <div class="offcanvas offcanvas-end animate-100" data-bs-scroll="true" tabindex="-1" id="canvasmenu" aria-labelledby="canvasmenuLabel">
                <div class="offcanvas-header bg-<?php echo _CONFIG["THEME_COLOR"]; ?>">
                    <div class="offcanvas-title" id="canvasmenuLabel">

                        <a href="<?php echo _get_url("index.php"); ?>" class="navbar-brand-md h2 text-decoration-none text-white"><i class="bi bi-life-preserver text-white display-5"></i></a>
                        <?php if (_get_is_logged_in()) : ?>

                            <div>
                                <span class="text-white fs-6">Logged in as <a href="<?php echo _get_url("view-profile.php"); ?>" class="list-group-item d-inline text-<?php echo _CONFIG['THEME_COLOR']; ?> rounded p-1"><?php echo ucfirst(strtok(_get_session_val("name"), " ")); ?></a></span>
                            </div>

                        <?php endif; ?>
                    </div>

                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body bg-<?php echo _CONFIG["THEME_COLOR"]; ?>">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center">

                            <?php primary_menu(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </header>
    <?php } ?>