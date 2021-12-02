<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(__FILE__) . "/helper/functions.php";

header_section("About Group 09");

?>

<main class="container py-2 my-3 border">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">About Us</h1>
        </div>
    </div>

    <hr>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="row">

            <?php if (_get_is_logged_in()) side_menu(); ?>

            <div class="col-md-<?php echo _get_is_logged_in() ? "9" : "12"; ?> col-lg-<?php echo _get_is_logged_in() ? "9" : "7"; ?> m-auto">
                <div class="table-responsive">
                    <table class="table table-<?php echo _CONFIG['THEME_COLOR']; ?> table-striped min-width-400px">
                        <thead class="table-dark ?>">
                            <tr>
                                <th>Name (AIUB style)</th>
                                <th>ID (AIUB)</th>
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
        </div>
</main>

<?php footer_section(); ?>