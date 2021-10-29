<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");

?>
<?php function footer_section()
{ ?>
    <footer class="container bg-<?php echo _CONFIG["THEME_COLOR"]; ?> p-3">
        <div class="row">
            <div class="col-sm-12 text-center">
                <p class="text-white mb-0"><span class="text-white"><?php echo date("Y"); ?> &copy; Copyright by <strong><a href="<?php echo _get_url("about.php"); ?>" class="list-group-item d-inline text-<?php echo _CONFIG['THEME_COLOR']; ?> rounded p-1">Group 09</a></strong></span></p>
            </div>
        </div>
    </footer>


    <!-- Bootstrap js with Popper -->
    <script src="<?php echo _get_assets_uri("bootstrap.bundle.min.js", "js"); ?>"></script>

    <!-- My scripts -->
    <script src="<?php echo _get_assets_uri("script.js", "js"); ?>"></script>
    </body>

    </html>
<?php } ?>