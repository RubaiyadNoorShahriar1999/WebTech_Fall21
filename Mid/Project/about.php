<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>

<?php require_once dirname(__FILE__) . "/helper/functions.php"; ?>

<?php


?>

<?php header_section("About Group 09"); ?>

    <main class="container p-2 my-3 border">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Group 09</h1>
            </div>
        </div>
        <hr>
        <div class="row gx-5 d-flex justify-content-center align-items-center">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "8" : "8"; ?>">
                <table class="table table-<?php echo _CONFIG['THEME_COLOR']; ?> table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name (AIUB style)</th>
                            <th scope="col">ID (AIUB)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Samuel, Nobir Hossain</td>
                            <td>19-41135-2</td>
                        </tr>
                        <tr>
                            <td>Sojib, Munem Al Shahrair</td>
                            <td>19-39537-1</td>
                        </tr>
                        <tr>
                            <td>Rahat, MD. Mohinor Rahman</td>
                            <td>19-39517-1</td>
                        </tr>
                        <tr>
                            <td>Moni, Khuko</td>
                            <td>19-39501-1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

<?php footer_section(); ?>