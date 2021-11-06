<?php

session_start();

require_once "../model/models.php";


function validate_input($str)
{
    return htmlspecialchars(trim($str));
}

$messages = [
    "errors" => [],
    "success" => "",
    "unsuccess" => "",
    "data" => []
];

if (isset($_POST['addproduct'])) {
    $has_err = false;

    $name = "";
    $buyingprice = "";
    $sellingprice = "";
    $display = "";

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

    // Display
    if (isset($_POST['display']) && preg_match("/on|off/", $_POST['display']) != 1) {
        $messages['errors']['display'] = "Invalid display value";
        $has_err = true;
    } else {
        $display = isset($_POST['display']) ? $_POST['display'] : "";
        $messages['data']['display'] = $display;
        // var_dump($_POST['display']);
    }

    // echo '<pre>';
    // var_dump($messages);
    // echo '</pre>';
    // exit;

    if (!$has_err) {
        $product = new Product();

        $product->setName($name);
        $product->setBuyingPrice($buyingprice);
        $product->setSellingPrice($sellingprice);

        if (addProduct($product)) {
            $messages['success'] = "Successfully added Product";

            if($display == "on")
            {
                $_SESSION['messages'] = $messages;
                header("Location: ../view-product.php");
                exit();
            }

            $_SESSION['messages'] = $messages;
            header("Location: ../add-product.php");
            exit();
        } else {
            $messages['unsuccess'] = "Unsuccessful to add Product";

            $_SESSION['messages'] = $messages;
            header("Location: ../add-product.php");
            exit();
        }
    } else {
        $_SESSION['messages'] = $messages;
        header("Location: ../add-product.php");
        exit();
    }
} else {
    $_SESSION['messages'] = $messages;
    header("Location: ../add-product.php");
    exit();
}
