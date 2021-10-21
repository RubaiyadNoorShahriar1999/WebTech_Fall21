<?php require_once "functions.php"; ?>
<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: dashboard.php");
    exit();
}

$has_err = false;
$credential_msg = "";

$username = "";
$err_username = "";

$password = "";
$err_password = "";

$rememberme = "";
$err_rememberme = "";

if (isset($_POST['login'])) {
    // Username
    if (empty($_POST['username'])) {
        $err_username = "Username can't be empty";
        $has_err = true;
    } else {
        $username = validate_input($_POST['username']);
    }

    // Password
    if (empty($_POST['password'])) {
        $err_password = "Password can't be empty";
        $has_err = true;
    } else {
        $password = validate_input($_POST['password']);
    }

    // Remember me
    if (isset($_POST['rememberme']) && !preg_match("/(on|off)/", $_POST['rememberme'])) {
        $err_rememberme = "Remember me value is invalid";
        $has_err = true;
    } else if (isset($_POST['rememberme'])) {
        $rememberme = validate_input($_POST['rememberme']);
    }

    // echo '<pre>';
    // var_dump($rememberme);
    // echo '</pre>';
    // return;

    if (!$has_err) {
        // Get data from json
        $users = json_decode(file_get_contents("db/users.json"), true);

        foreach ($users as $user) {
            // echo $user['username'] . "<br>";
            if ($user['username'] === $username && $user['password'] === $password) {
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['gender'] = $user['gender'];
                $_SESSION['dob'] = $user['dob'];
                $_SESSION['pp_path'] = $user['pp_path'];
                $_SESSION['loggedin'] = true;

                break;
            }
        }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
            if ($rememberme == "on") {
                // 60 * 60 * 24 * 7 = 7 days
                $exprire = 60 * 60 * 24 * 7;

                setcookie('username', $_SESSION['username'], time() + $exprire);
                setcookie('email', $_SESSION['email'], time() + $exprire);
            }

            header("Location: dashboard.php");
        } else {
            $credential_msg = "Your credential is not correct";
        }

        // echo '<pre>';
        // var_dump($_COOKIE['username']);
        // echo '</pre>';
    }
}
?>

<?php header_page("Login"); ?>

<?php primary_menu(); ?>

    <section class="main">

        <?php // aside_menu(); ?>

        <main class="main__content main__content--login">
            <form class="main__content--login__form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <legend>Login</legend>
                    <div>
                        <table>
                            <tr>
                                <td><label for="username">Username</label></td>
                                <td>: <input type="text" name="username" id="username" value="<?php echo $username ?>"></td>
                                <td><span class="error"><?php echo $err_username; ?></span></td>
                            </tr>
                            <tr>
                                <td><label for="password">Password</label></td>
                                <td>: <input type="password" name="password" id="password" value="<?php echo $password ?>"></td>
                                <td><span class="error"><?php echo $err_password; ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div>
                        <input type="checkbox" name="rememberme" id="rememberme">
                        <label for="rememberme">Remember Me</label>
                        <span class="error"><?php echo $err_rememberme; ?></span><br><br>
                        <input type="submit" name="login" value="Submit">
                        <span><a href="forget-password.php">Forget Password?</a></span><br><br>
                        <span class="error"><?php echo $credential_msg; ?></span>
                    </div>
                </fieldset>
            </form>
        </main>
    </section>

<?php footer_page(); ?>