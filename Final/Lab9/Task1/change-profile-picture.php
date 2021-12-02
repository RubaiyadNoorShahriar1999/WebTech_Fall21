<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>
<?php require_once __DIR__ . "/helper/functions.php"; ?>
<?php require_once _ROOT_DIR . "controller/ChangeProfilePictureController.php"; ?>

<?php


?>

<?php header_page("Change Profile Picture"); ?>

<?php primary_menu(); ?>

    <section class="main">

        <?php aside_menu(); ?>

        <main class="main__content main__content--change-pp">
            <form class="main__content--change-pp__form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>PROFILE PICTURE</legend>
                    <div>
                        <table>
                            <tr>
                                <td><img src="<?php echo !empty($_SESSION['pp_path']) ? $_SESSION['pp_path'] : "images/default-pp.png"; ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="file" name="picture" id="picture"></td>
                                <td><span class="error"><?php echo $err_picture; ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div>
                        <input type="submit" name="profilepic" value="Submit">
                        <span class="success"><?php echo $success_msg; ?></span>
                        <span class="erroe"><?php echo $unsuccess_msg; ?></span>
                    </div>
                </fieldset>
            </form>
        </main>
    </section>

<?php footer_page(); ?>