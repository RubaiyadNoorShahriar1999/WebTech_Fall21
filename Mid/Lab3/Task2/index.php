<?php

$currentpass = "";
$err_currentpass = "";

$newpass = "";
$err_newpass = "";

$retypepass = "";
$err_retypepass = "";

if (isset($_POST['changepassword'])) {
    // Current Password
    define("CURRENT_PASSWORD", "abc@1234");

    if (empty($_POST['currentpass'])) {
        $err_currentpass = "<span class=\"error\">Current Password can't be empty</span>";
    } else if ($_POST['currentpass'] != CURRENT_PASSWORD) {
        $err_currentpass = "<span class=\"error\">Current Password is not corrent</span>";
    } else {
        $currentpass = trim($_POST['currentpass']);
    }

    // New Password
    if (empty($_POST['newpass'])) {
        $err_newpass = "<span class=\"error\">New Password can't be empty</span>";
    } else if (strlen(trim($_POST['newpass'])) <= 7) {
        $err_newpass = "<span class=\"error\">New Password must be 8 characters or greater</span>";
    } else if (!preg_match("/[@#$%]+/", $_POST['newpass'])) {
        $err_newpass = "<span class=\"error\">New Password must include special characters (@ # $ %)</span>";
    } else if ($_POST['newpass'] == $currentpass) {
        $err_newpass = "<span class=\"error\">New Password must not be same as Current Password</span>";
    } else {
        $newpass = trim($_POST['newpass']);
    }

    // Retype Password
    if (empty($_POST['retypepass'])) {
        $err_retypepass = "<span class=\"error\">Retype Password can't be empty</span>";
    } else if ($_POST['retypepass'] != $newpass) {
        $err_retypepass = "<span class=\"error\">Retype Password must equal to New Password</span>";
    } else {
        $retypepass = trim($_POST['retypepass']);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lab 3 Task 2</title>

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
            <legend>CHANGE PASSWORD</legend>
            <div>
                <table>
                    <tr>
                        <td><label for="currentpass">Current Password:</label></td>
                        <td><input type="password" name="currentpass" id="currentpass" value="<?php echo $currentpass ?>"></td>
                        <td><?php echo $err_currentpass; ?></td>
                    </tr>
                    <tr>
                        <td><label for="newpass" style="color: green;">New Password:</label></td>
                        <td><input type="password" name="newpass" id="newpass" value="<?php echo $newpass ?>"></td>
                        <td><?php echo $err_newpass; ?></td>
                    </tr>
                    <tr>
                        <td><label for="retypepass" style="color: red;">Retype New Password:</label></td>
                        <td><input type="password" name="retypepass" id="retypepass" value="<?php echo $retypepass ?>"></td>
                        <td><?php echo $err_retypepass; ?></td>
                    </tr>
                </table>
            </div>
            <hr>
            <div>
                <input type="submit" name="changepassword" value="Submit">
            </div>
        </fieldset>
    </form>

</body>

</html>