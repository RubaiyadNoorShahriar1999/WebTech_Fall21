<?php

$username = "";
$err_username = "";

$password = "";
$err_password = "";

if (isset($_POST['login'])) {
    // Username
    if (empty($_POST['username'])) {
        $err_username = "<span class=\"error\">Username can't be empty</span>";
    } else if (strlen(trim($_POST['username'])) < 2) {
        $err_username = "<span class=\"error\">Username must be larger than 2 characters</span>";
    } else if (!preg_match("/^([a-zA-Z0-9.-]*)$/", $_POST['username'])) {
        $err_username = "<span class=\"error\">Username must be alphanumeric, period and dashes</span>";
    } else {
        $username = validate_input($_POST['username']);
    }

    // Password
    if (empty($_POST['password'])) {
        $err_password = "<span class=\"error\">Password can't be empty</span>";
    } else if (strlen(trim($_POST['password'])) < 8) {
        $err_password = "<span class=\"error\">Password must be 8 characters or greater</span>";
    } else if (!preg_match("/[@#$%]+/", $_POST['password'])) {
        $err_password = "<span class=\"error\">Password must include special characters (@ # $ %)</span>";
    } else {
        $password = validate_input($_POST['password']);
    }
}

function validate_input($str)
{
    return htmlspecialchars(trim($str));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lab 3 Task 1</title>

    <style>
        table tr td:first-child {
            text-align: right;
        }

        span.error {
            color: red;
        }
    </style>
</head>

<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <fieldset>
            <legend>Login</legend>
            <div>
                <table>
                    <tr>
                        <td><label for="username">Username:</label></td>
                        <td><input type="text" name="username" id="username"></td>
                        <td><?php echo $err_username; ?></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" id="password"></td>
                        <td><?php echo $err_password; ?></td>
                    </tr>
                </table>
            </div>
            <hr>
            <div>
                <input type="checkbox" name="rememberme" id="rememberme">
                <label for="rememberme">Remember Me</label><br><br>
                <input type="submit" name="login" value="Submit">
                <span><a href="#">Forget Password?</a></span>
            </div>
        </fieldset>
    </form>

</body>

</html>