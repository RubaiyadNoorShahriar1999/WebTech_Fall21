<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>
<?php require_once __DIR__ . "/helper/functions.php"; ?>
<?php require_once _ROOT_DIR . "controller/ForgetPasswordController.php"; ?>

<?php



?>

<?php header_page("Forget Password"); ?>

<?php primary_menu(); ?>

    <section class="main">

        <?php // aside_menu(); ?>

        <main class="main__content main__content--forget-pass">
            <form class="main__content--forget-pass__form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <legend>FORGET PASSWORD</legend>
                    <div>
                        <table>
                            <tr>
                                <td><label for="email">Enter Email</label></td>
                                <td>: <input type="text" name="email" id="email" value="<?php echo $email ?>"></td>
                                <td><span class="error"><?php echo $err_email; ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div>
                        <input type="submit" name="forget-pass" value="Submit">
                    </div>
                </fieldset>
            </form>
        </main>
    </section>

<?php footer_page(); ?>