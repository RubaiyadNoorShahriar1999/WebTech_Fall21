<?php require_once "functions.php"; ?>
<?php

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit();
}

$has_err = false;
$has_duplicate = false;
$success_msg = "";

$name = "";
$err_name = "";

$email = "";
$err_email = "";

$gender = "";
$err_gender = "";

$dob = "";
$err_dob = "";

if (isset($_POST['edit'])) {
    // Name
    if (empty($_POST['name'])) {
        $err_name = "Name is required";
        $has_err = true;
    } else if (strlen($_POST['name']) < 2) {
        $err_name = "Name must be greater than 2 character";
        $has_err = true;
    } else if (preg_match("/^[a-zA-Z-.]/", $_POST['name']) != 1) {
        $err_name = "Name must be contains alpha character, (.) and (-)";
        $has_err = true;
    } else {
        $name = validate_input($_POST['name']);
    }

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

    // Gender
    if (empty($_POST['gender'])) {
        $err_gender = "Date of birth is required";
        $has_err = true;
    } else {
        $gender = validate_input($_POST['gender']);
    }

    // DOB
    if (empty($_POST['dob'])) {
        $err_dob = "Date of birth is required";
        $has_err = true;
    } else if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $_POST['dob']) != 1) {
        $err_dob = "Date of birth is not valid";
        $has_err = true;
    } else {
        $dob = validate_input($_POST['dob']);
    }

    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    // Store data in JSON
    if (!$has_err) {
        // Get previous data from json
        $users = json_decode(file_get_contents("db/users.json"), true);

        // Check duplication
        if (!empty($users) && $_SESSION['email'] != $email) {
            foreach ($users as $user) {
                if ($user['email'] == $email) {
                    if ($user['email'] == $email) {
                        $err_email = "Email already registered";
                    }

                    $has_err = true;
                    $has_duplicate = true;

                    break;
                }
            }
        }

        // Change on the json file and also Session if applicable
        if (!$has_duplicate) {
            // Find the user
            for ($i = 0; $i < count($users); ++$i) {
                // Checking with username cause email can be change if possible
                if ($users[$i]['username'] == $_SESSION['username']) {
                    // Set edited data to session
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['gender'] = $gender;
                    $_SESSION['dob'] = $dob;

                    // Change data in the array
                    $users[$i]['name'] = $_SESSION['name'];
                    $users[$i]['email'] = $_SESSION['email'];
                    $users[$i]['gender'] = $_SESSION['gender'];
                    $users[$i]['dob'] = $_SESSION['dob'];

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

            $success_msg = "Successfully Edited";

            // echo '<pre>';
            // var_dump($json);
            // echo '</pre>';
        }
    }
}
?>

<?php header_page("Edit Profile"); ?>

<?php primary_menu(); ?>

    <section class="main">

        <?php aside_menu(); ?>

        <main class="main__content main__content--edit-profile">
            <!-- <form class="main__content--edit-profile__form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"> -->
            <form class="main__content--edit-profile__form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <fieldset>
                    <legend>EDIT PROFILE</legend>
                    <div>
                        <table>
                            <tr>
                                <td><label for="name">Name</label></td>
                                <td>: <input type="text" name="name" id="name" value="<?php echo $_SESSION['name']; ?>"></td>
                                <td class="error"><?php echo $err_name ?></td>
                            </tr>
                        </table>
                        <hr>
                        <table>
                            <tr>
                                <td><label for="email">Email</label></td>
                                <td>: <input type="text" name="email" id="email" value="<?php echo $_SESSION['email']; ?>"></td>
                                <td class="error"><?php echo $err_email ?></td>
                            </tr>
                        </table>
                        <hr>
                        <table>
                            <tr>
                                <td><label>Gender</label></td>
                                <td>:
                                    <input type="radio" name="gender" value="male" id="male" <?php echo ($_SESSION['gender'] == "male") ? " checked" : ""; ?>><label for="male">Male</label>
                                    <input type="radio" name="gender" value="female" id="female" <?php echo ($_SESSION['gender'] == "female") ? " checked" : ""; ?>><label for="female">Female</label>
                                    <input type="radio" name="gender" value="other" id="other" <?php echo ($_SESSION['gender'] == "other") ? " checked" : ""; ?>><label for="other">Other</label>
                                </td>
                                <td><span class="error"><?php echo $err_gender; ?></span></td>
                            </tr>
                        </table>
                        <hr>
                        <table>
                            <td><label for="dob">Date of Birth</label></td>
                            <td>: <input type="date" name="dob" value="<?php echo $_SESSION['dob']; ?>" id="dob"></td>
                            <td><span class="error"><?php echo $err_dob; ?></span></td>
                        </table>
                        <hr>
                    </div>
                    <div>
                        <input type="submit" name="edit" value="Submit">
                        <span class="success"><?php echo $success_msg; ?></span>
                    </div>
                </fieldset>
            </form>
        </main>
    </section>

<?php footer_page(); ?>