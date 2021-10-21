<?php require_once "functions.php"; ?>
<?php

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit();
}

$upload_ok = false;
$success_msg = "";

$picture = "";
$err_picture = "";

if (isset($_POST['profilepic'])) {

    if ($_FILES['picture']['error'] != 0) {
        $err_picture = "Choose a image file";
        $upload_ok = false;
    } else {
        $custom_dir = "/db/uploads/";
        $upload_dir = dirname(__FILE__) . $custom_dir;
        $target_file = $upload_dir . $_SESSION['username'] . "_" . basename($_FILES["picture"]["name"]);
        $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["picture"]["tmp_name"]);

        if ($check === false) {
            $err_picture = "File is not an image.";
            $upload_ok = false;
        } else if (file_exists($target_file)) {
            $err_picture = "Image already exits";
            $upload_ok = false;
        } else if ($_FILES['picture']['size'] > (4 * 1024 * 1024)) {  // 4MB
            $err_picture = "Image size must be less than 4MB";
            $upload_ok = false;
        } else if (!preg_match("/jpeg|jpg|png/", $image_type)) {
            $err_picture = "Image format must be jpeg or jpg or png";
            $upload_ok = false;
        } else {
            $picture = dirname($_SERVER['PHP_SELF']) . $custom_dir . $_SESSION['username'] . "_" . basename($_FILES["picture"]["name"]);
            $upload_ok = true;
        }

        // Move the actual file to uploads directory
        if ($upload_ok === true) {
            if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                $err_picture = "There was an error to uploading your image";
                $_SESSION['pp_path'] = "";
                $upload_ok = false;
            } else {
                // Get data from json
                $users = json_decode(file_get_contents("db/users.json"), true);

                // Find the user
                for ($i = 0; $i < count($users); ++$i) {
                    // Checking with username cause email can be change if possible
                    if ($users[$i]['username'] == $_SESSION['username']) {
                        // Set edited data to session
                        $_SESSION['pp_path'] = $picture;

                        // Change data in the array
                        $users[$i]['pp_path'] = $_SESSION['pp_path'];

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

                $success_msg = "Successfully changed";

                // echo '<pre>';
                // var_dump($json);
                // echo '</pre>';
            }
        }

        // echo '<pre>';
        // var_dump($_SESSION['pp_path']);
        // echo '</pre>';
        // return;
    }
}

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
                    </div>
                </fieldset>
            </form>
        </main>
    </section>

<?php footer_page(); ?>