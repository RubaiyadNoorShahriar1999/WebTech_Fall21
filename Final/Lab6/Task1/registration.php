<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

?>
<?php require_once __DIR__ . "/helper/functions.php"; ?>
<?php require_once _ROOT_DIR . "controller/RegistrationController.php"; ?>
<?php

?>

<?php header_page("Registration"); ?>

<?php primary_menu(); ?>

    <section class="main">

        <?php // aside_menu(); ?>

        <main class="main__content main__content--registration">
            <!-- <form class="main__content--registration__form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"> -->
            <form class="main__content--registration__form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <legend>REGISTRATION</legend>
                    <div>
                        <table>
                            <tr>
                                <td><label for="name">Name</label></td>
                                <td>:<input type="text" name="name" id="name" value="<?php echo $name; ?>"></td>
                                <td class="error"><?php echo $err_name; ?></td>
                            </tr>
                        </table>
                        <hr>
                        <table>
                            <tr>
                                <td><label for="email">Email</label></td>
                                <td>:<input type="text" name="email" id="email" value="<?php echo $email; ?>"></td>
                                <td class="error"><?php echo $err_email; ?></td>
                            </tr>
                        </table>
                        <hr>
                        <table>
                            <tr>
                                <td><label for="username">User Name</label></td>
                                <td>:<input type="text" name="username" id="username" value="<?php echo $username; ?>"></td>
                                <td class="error"><?php echo $err_username; ?></td>
                            </tr>
                        </table>
                        <hr>
                        <table>
                            <tr>
                                <td><label for="password">Password</label></td>
                                <td>:<input type="password" name="password" id="password" value="<?php echo $password; ?>"></td>
                                <td class="error"><?php echo $err_password; ?></td>
                            </tr>
                        </table>
                        <hr>
                        <table>
                            <tr>
                                <td><label for="cpassword">Confirm Password</label></td>
                                <td>:<input type="password" name="cpassword" id="cpassword" value="<?php echo $cpassword; ?>"></td>
                                <td class="error"><?php echo $err_cpassword; ?></td>
                            </tr>
                        </table>
                        <hr>
                        <fieldset>
                            <legend>Gender</legend>
                            <input type="radio" name="gender" value="male" id="male" <?php echo ($gender == "male") ? " checked" : ""; ?>><label for="male">Male</label>
                            <input type="radio" name="gender" value="female" id="female" <?php echo ($gender == "female") ? " checked" : ""; ?>><label for="female">Female</label>
                            <input type="radio" name="gender" value="other" id="other" <?php echo ($gender == "other") ? " checked" : ""; ?>><label for="other">Other</label>
                            <span class="error"><?php echo $err_gender; ?></span>
                        </fieldset>
                        <fieldset>
                            <legend>Date of Birth</legend>
                            <input type="date" name="dob" value="<?php echo $dob; ?>" id="dob">
                            <span class="error"><?php echo $err_dob; ?></span>
                        </fieldset>
                    </div>
                    <div>
                        <input type="submit" name="registration" value="Submit">
                        <input type="reset" id="reset">
                        <span class="success"><?php echo $success_msg; ?></span>
                        <span class="error"><?php echo $unsuccess_msg; ?></span>
                    </div>
                </fieldset>
            </form>
        </main>
    </section>

<?php footer_page(); ?>