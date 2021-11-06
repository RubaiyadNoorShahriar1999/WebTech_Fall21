<?php

session_start();

// require_once "./model/models.php";


function validate_input($str)
{
    return htmlspecialchars(trim($str));
}

if (isset($_POST['editproduct'])) {

    require_once "../model/models.php";

    $messages = [
        "errors" => [],
        "success" => "",
        "unsuccess" => "",
        "data" => []
    ];

    $has_err = false;

    $name = "";
    $buyingprice = "";
    $sellingprice = "";

    // Name
    if (empty($_POST['name'])) {
        $messages['errors']['name'] = "Name is required";
        $has_err = true;
    } else if (strlen($_POST['name']) < 2) {
        $messages['errors']['name'] = "Name must be greater than 2 character";
        $has_err = true;
    } else if (preg_match("/^[a-zA-Z-.]/", $_POST['name']) != 1) {
        $messages['errors']['name'] = "Name must be contains alpha character, (.) and (-)";
        $has_err = true;
    } else {
        $name = validate_input($_POST['name']);
        $messages['data']['name'] = $name;
    }

    // Buying price
    if (empty($_POST['buyingprice'])) {
        $messages['errors']['buyingprice'] = "Buying price is required";
        $has_err = true;
    } else if (!is_numeric($_POST['buyingprice'])) {
        $messages['errors']['buyingprice'] = "Buying price must be numeric";
        $has_err = true;
    } else {
        $buyingprice = validate_input($_POST['buyingprice']);
        $messages['data']['buyingprice'] = $buyingprice;
    }

    // Selling price
    if (empty($_POST['sellingprice'])) {
        $messages['errors']['sellingprice'] = "Selling price is required";
        $has_err = true;
    } else if (!is_numeric($_POST['sellingprice'])) {
        $messages['errors']['sellingprice'] = "Selling price must be numeric";
        $has_err = true;
    } else {
        $sellingprice = validate_input($_POST['sellingprice']);
        $messages['data']['sellingprice'] = $sellingprice;
    }

    // echo '<pre>';
    // var_dump($messages);
    // echo '</pre>';
    // exit;

    if (!$has_err) {
        $product = new Product();

        $product->setId($_POST['id']);
        $product->setName($name);
        $product->setBuyingPrice($buyingprice);
        $product->setSellingPrice($sellingprice);

        if (editProduct($product)) {
            $messages['success'] = "Successfully edited Product";

            $_SESSION['messages'] = $messages;
            header("Location: ../edit-product.php?id=" . $_POST['id']);
            exit();
        } else {
            $messages['unsuccess'] = "Unsuccessful to edit Product";

            $_SESSION['messages'] = $messages;
            header("Location: ../edit-product.php?id=" . $_POST['id']);
            exit();
        }
    } else {
        $_SESSION['messages'] = $messages;
        header("Location: ../edit-product.php?id=" . $_POST['id']);
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
