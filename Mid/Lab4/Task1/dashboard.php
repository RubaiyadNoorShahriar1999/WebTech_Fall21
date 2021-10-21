<?php require_once "functions.php"; ?>
<?php

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit();
}

?>

<?php header_page("Dashboard"); ?>

<?php primary_menu(); ?>

    <section class="main">

        <?php aside_menu(); ?>

        <main class="main__content">
            <h1>Welcome <?php echo ucfirst($_SESSION['username']); ?></h1>
        </main>
    </section>

<?php footer_page(); ?>