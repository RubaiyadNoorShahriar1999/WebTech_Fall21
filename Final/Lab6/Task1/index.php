<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>
<?php require_once __DIR__ . "/helper/functions.php"; ?>

<?php

// if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
//     header("Location: dashboard.php");
//     exit();
// }

// require_once _ROOT_DIR . "models/User/UsersModel.php";

// echo '<pre>';
// var_dump(getUserById(1));
// var_dump(getUserByUsername("nobir"));
// echo '</pre>';

?>

<?php header_page("Public Home"); ?>

<?php primary_menu(); ?>

    <section class="main">

        <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                aside_menu();
            }
        ?>

        <main class="main__content">
            <h1>Welcome to xCompany</h1>
        </main>
    </section>

<?php footer_page(); ?>