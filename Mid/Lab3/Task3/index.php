<?php

$picture = "";
$err_picture = "";
$upload_ok = false;

if (isset($_POST['profilepic'])) {

    if ($_FILES['picture']['error'] != 0) {
        $err_picture = "Choose a image file";
        $upload_ok = false;
    } else {

        $upload_dir = dirname(__FILE__) . "/uploads/";
        $target_file = $upload_dir . basename($_FILES["picture"]["name"]);
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
            $picture = dirname($_SERVER['PHP_SELF']) . "/uploads/" . basename($_FILES["picture"]["name"]);
            $upload_ok = true;
        }

        if ($upload_ok === true) {
            if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                $err_picture = "There was an error to uploading your image";
                $upload_ok = false;
            }
        }

        // echo '<pre>';
        // var_dump($picture);
        // echo '</pre>';
        // return;
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lab 3 Task 3</title>
    <style>
        tr > td:last-child {
            color: red;
        }

        img {
            display: block;
            width: 400px;
        }
    </style>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>PROFILE PICTURE</legend>
            <div>
                <table>
                    <?php if (!empty($picture)) : ?>

                        <tr>
                            <td><img src="<?php echo $picture ?>"></td>
                            <td></td>
                        </tr>

                    <?php endif; ?>
                    <tr>
                        <td><input type="file" name="picture" id="picture"></td>
                        <td><?php echo $err_picture; ?></td>
                    </tr>
                </table>
            </div>
            <hr>
            <div>
                <input type="submit" name="profilepic" value="Submit">
            </div>
        </fieldset>
    </form>
</body>

</html>