<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

require_once dirname(dirname(__FILE__)) . "/helper/functions.php";

if (!_get_is_logged_in()) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['changepp'])) {

    $upload_ok = false;
    $messages = [
        "errors" => [],
        "success" => [],
        "data" => []
    ];

    $picture = "";

    // _var_dump($_POST);
    // _var_dump($_FILES);
    // return;

    if ($_FILES['picture']['error'] != 0) {
        $messages["errors"][] = "Choose a image file";
        $upload_ok = false;
    } else {
        $upload_dir = _ROOT_DIR . _CONFIG['UPLOAD_DIR'];
        $target_file = $upload_dir . _get_session_val('email') . "_" . basename($_FILES["picture"]["name"]);
        $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["picture"]["tmp_name"]);

        if ($check === false) {
            $messages["errors"][] = "File is not an image.";
            $upload_ok = false;
        } else if (file_exists($target_file)) {
            $messages["errors"][] = "Image already exits";
            $upload_ok = false;
        } else if ($_FILES['picture']['size'] > (4 * 1024 * 1024)) {  // 4MB
            $messages["errors"][] = "Image size must be less than 4MB";
            $upload_ok = false;
        } else if (!preg_match("/jpeg|jpg|png/", $image_type)) {
            $messages["errors"][] = "Image format must be jpeg or jpg or png";
            $upload_ok = false;
        } else {
            $picture = _get_session_val('email') . "_" . basename($_FILES["picture"]["name"]);
            $upload_ok = true;
        }
    }

    // _var_dump($_POST);
    // return;
    // _var_dump($messages);
    // return;

    // Move the actual file to uploads directory
    if ($upload_ok) {

        require_once _ROOT_DIR . "model/UserModel.php";

        if (_upload_profile_pic($picture, $target_file)) {
            // Send successful message
            $messages = [
                "errors" => [],
                "success" => [
                    "Successfully Edited"
                ],
                "data" => []
            ];
            _set_session_val("messages", $messages);
            header("Location: ../change-pp.php");
        } else {
            $messages["errors"][] = "There was an error to uploading your image";
            $upload_ok = false;

            _set_session_val("messages", $messages);
            header("Location: ../change-pp.php");
            exit();
        }
    } else {
        _set_session_val("messages", $messages);
        header("Location: ../change-pp.php");
        exit();
    }
} else {
    header("Location: ../change-pp.php");
    exit();
}
