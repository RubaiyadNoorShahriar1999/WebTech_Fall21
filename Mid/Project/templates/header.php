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

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo _get_assets_uri("bootstrap.min.css", "css"); ?>">

    <!-- My custom css -->
    <link rel="stylesheet" href="<?php echo _get_assets_uri("style.css", "css"); ?>">
</head>

<body>
    <header class="container bg-<?php echo _CONFIG["THEME_COLOR"]; ?> p-3">
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <a href="<?php echo _get_url("index.php"); ?>" class="navbar-brand-md h2 text-decoration-none text-white">EMS</a>
                <?php if (_get_is_logged_in()) : ?>

                    <div>
                        <span class="text-white fs-6">Logged in as <a href="<?php echo _get_url("view-profile.php"); ?>" class="list-group-item d-inline text-<?php echo _CONFIG['THEME_COLOR']; ?> rounded p-1"><?php echo ucfirst(strtok(_get_session_val("name"), " ")); ?></a></span>
                    </div>

                <?php endif; ?>
            </div>
            <div class="col-sm-12 col-md-9">

                <?php primary_menu(); ?>

            </div>
        </div>
    </header>
<?php } ?>