<?php require_once "functions.php"; ?>
<?php

// if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
//     header("Location: dashboard.php");
//     exit();
// }

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