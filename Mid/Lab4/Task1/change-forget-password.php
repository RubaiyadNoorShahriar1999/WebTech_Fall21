<?php require_once "functions.php"; ?>
<?php

// This will check if "actual user" request for new password
if (!isset($_SESSION['forget_pass']) || !isset($_SESSION['foget_pass_email'])) {
    header("Location: forget-password.php");
    exit();
}

$has_err = false;
$success_msg = "";

$newpass = "";
$err_newpass = "";

$retypepass = "";
$err_retypepass = "";

if (isset($_POST['changeforgetpass'])) {
    // Get data from json
    $users = json_decode(file_get_contents("db/users.json"), true);
    $current_user = [];

    // Find the user
    for ($i = 0; $i < count($users); ++$i) {
        if ($users[$i]['email'] == $_SESSION['foget_pass_email']) {
            $current_user = $users[$i];
            break;
        }
    }

    // New Password
    if (empty($_POST['newpass'])) {
        $err_newpass = "New Password can't be empty";
        $has_err = true;
    } else if (strlen(trim($_POST['newpass'])) <= 7) {
        $err_newpass = "New Password must be 8 characters or greater";
        $has_err = true;
    } else if (!preg_match("/[@#$%]+/", $_POST['newpass'])) {
        $err_newpass = "New Password must include special characters (@ # $ %)";
        $has_err = true;
    } else if ($_POST['newpass'] == $current_user['password']) {
        $err_newpass = "New Password must not be same previous password";
        $has_err = true;
    } else {
        $newpass = trim($_POST['newpass']);
    }

    // Retype Password
    if (empty($_POST['retypepass'])) {
        $err_retypepass = "Retype Password can't be empty";
        $has_err = true;
    } else if ($_POST['retypepass'] != $newpass) {
        $err_retypepass = "Retype Password must equal to New Password";
        $has_err = true;
    } else {
        $retypepass = trim($_POST['retypepass']);
    }

    // Store data in JSON
    if (!$has_err) {
        // Find the user
        for ($i = 0; $i < count($users); ++$i) {
            if ($users[$i]['email'] == $_SESSION['foget_pass_email']) {
                // Change data in the array
                $users[$i]['password'] = $newpass;

                // Destroy the session data
                session_reset();
                session_unset();
                session_destroy();

                // echo '<pre>';
                // var_dump($users);
                // echo '</pre>';

                break;
            }
        }

        // Convert associative array to json string
        $json = json_encode($users);

        // Put all the json string to the file
        file_put_contents("db/users.json", $json);

        $success_msg = "Successfully Changed";

        // echo '<pre>';
        // var_dump($json);
        // echo '</pre>';
    }
}

?>

<?php header_page("Change Password"); ?>

<?php primary_menu(); ?>

    <section class="main">

        <?php aside_menu(); ?>

        <main class="main__content main__content--change-forget-pass">
            <form class="main__content--change-forget-pass__form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <legend>CHANGE PASSWORD</legend>
                    <div>
                        <table>
                            <tr>
                                <td><label for="newpass" style="color: green;">New Password</label></td>
                                <td>: <input type="password" name="newpass" id="newpass" value="<?php echo $newpass; ?>"></td>
                                <td><span class="error"><?php echo $err_newpass; ?></span></td>
                            </tr>
                            <tr>
                                <td><label for="retypepass" style="color: red;">Retype New Password</label></td>
                                <td>: <input type="password" name="retypepass" id="retypepass" value="<?php echo $retypepass; ?>"></td>
                                <td><span class="error"><?php echo $err_retypepass; ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div>
                        <input type="submit" name="changeforgetpass" value="Submit">
                        <span class="success"><?php echo $success_msg; ?></span>
                    </div>
                </fieldset>
            </form>
        </main>
    </section>

<?php footer_page(); ?>