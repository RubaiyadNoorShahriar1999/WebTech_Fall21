<?php


if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit();
}

$upload_ok = false;
$success_msg = "";
$unsuccess_msg = "";

$picture = "";
$err_picture = "";

if (isset($_POST['profilepic'])) {
    
    // _var_dump(_CONFIG['UPLOAD_DIR']);
    // exit;
    if ($_FILES['picture']['error'] != 0) {
        $err_picture = "Choose a image file";
        $upload_ok = false;
    } else {
        $custom_dir = _CONFIG['UPLOAD_DIR'];
        $upload_dir = _ROOT_DIR . $custom_dir;
        $save_file_name = $_SESSION['username'] . "_" . basename($_FILES["picture"]["name"]);
        $target_file = $upload_dir . $save_file_name;
        $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // _var_dump($save_file_name);
        // _var_dump($upload_dir);
        // _var_dump($target_file);
        // exit;

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
            $picture = dirname($_SERVER['PHP_SELF']) . "/" . $custom_dir . $save_file_name;
            $upload_ok = true;
        }

        // _var_dump($picture);
        // exit;

        // Move the actual file to uploads directory
        if ($upload_ok === true) {
            if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                $err_picture = "There was an error to uploading your image";
                $_SESSION['pp_path'] = "";
                $upload_ok = false;
            } else {
                require_once _ROOT_DIR . "models/User/UsersModel.php";
                $current_user = getUserByUsername($_SESSION['username']);

                // _var_dump($current_user);
                // exit;

                $is_updated = updateProfilePicture($picture, $current_user['u_id']);

                if ($is_updated) {

                    $_SESSION['pp_path'] = $picture;

                    $success_msg = "Successfully Changed";
                    $unsuccess_msg = "";
                } else {
                    $success_msg = "";
                    $unsuccess_msg = "No Change !!";
                }
            }
        }
    }
}
