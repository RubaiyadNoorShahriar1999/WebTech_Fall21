<?php

session_start();

// require_once "./model/models.php";


function validate_input($str)
{
    return htmlspecialchars(trim($str));
}

if (isset($_POST['deleteproduct'])) {

    require_once "../model/models.php";

    $messages = [
        "errors" => [],
        "success" => "",
        "unsuccess" => "",
        "data" => []
    ];

    $has_err = false;

    $id = "";

    // Name
    if (empty($_POST['id'])) {
        $messages['errors']['id'] = "ID is required";
        $has_err = true;
    } else if (!is_numeric($_POST['id'])) {
        $messages['errors']['id'] = "ID must be a number";
        $has_err = true;
    } else {
        $id = validate_input($_POST['id']);
        $messages['data']['id'] = $id;
    }

    // echo '<pre>';
    // var_dump($messages);
    // echo '</pre>';
    // exit;

    if (!$has_err) {

        if (deleteProduct($id)) {
            header("Location: ../view-product.php");
            exit();
        } else {
            $messages['unsuccess'] = "Unsuccessful to delete Product";

            $_SESSION['messages'] = $messages;
            header("Location: ../delete-product.php?id=" . $id);
            exit();
        }
    } else {
        $_SESSION['messages'] = $messages;
        header("Location: ../delete-product.php?id=" . $id);
        exit();
    }
} else if (isset($_GET['id'])) {

    require_once "./model/models.php";

    $data = getProduct($_GET['id']);
    // echo '<pre>';
    // var_dump($data);
    // echo '</pre>';


    $messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : [
        "errors" => [],
        "success" => "",
        "unsuccess" => "",
        "data" => []
    ];

    if ($data) {

        $messages['data'] = [
            'id' => $data['p_id'],
            'name' => $data['p_name'],
            'buyingprice' => $data['p_bp'],
            'sellingprice' => $data['p_sp']
        ];

        $_SESSION['messages'] = $messages;
    } else {
        $messages['unsuccess'] = "No Products found";
        $_SESSION['messages'] = $messages;
    }
}
