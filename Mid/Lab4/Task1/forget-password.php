<?php require_once "functions.php"; ?>
<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: dashboard.php");
    exit();
}

$has_err = false;

$email = "";
$err_email = "";

if (isset($_POST['forget-pass'])) {
    // Email
    if (empty($_POST['email'])) {
        $err_email = "Email is required";
        $has_err = true;
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $err_email = "Email is not valid";
        $has_err = true;
    } else {
        $email = validate_input($_POST['email']);
    }

    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
    // return;

    if (!$has_err) {
        // Get data from json
        $users = json_decode(file_get_contents("db/users.json"), true);

        $found_user = [];

        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $found_user = $user;
                break;
            }
        }

        if (!empty($found_user)) {
            // This will prevent direcly change password by url
            $_SESSION['forget_pass'] = true;
            $_SESSION['foget_pass_email'] = $found_user['email'];

            // Redirect to add new password
            header("Location: change-forget-password.php");
        } else {
            $err_email = "Can not find the Email on Database";
            $has_err = true;
        }
    }
}
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