<?php

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: view-product.php");
    exit();
}

if (!isset($_POST['deleteproduct'])) {

    require_once "./controller/DeleteProduct.php";
}

$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : [
    "errors" => [],
    "success" => "",
    "unsuccess" => "",
    "data" => []
];

$_SESSION['messages'] = [
    "errors" => [],
    "success" => "",
    "unsuccess" => "",
    "data" => []
];

// echo '<pre>';
// var_dump($_SESSION['messages']);
// echo '</pre>';

// echo '<pre>';
// var_dump($messages);
// echo '</pre>';
// exit;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lab 5 Task 1 | Delete Product</title>

    <style>
        .error {
            color: red;
        }

        .success {
            color: green;
        }

        table tr td:first-child {
            width: 150px;
        }

        nav ul li {
            background-color: lightgreen;
            display: inline-block;
        }

        nav ul li a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="add-product.php">Add Product</a></li>
            <li><a href="view-product.php">View Product</a></li>
        </ul>
    </nav>
    <form action="./controller/DeleteProduct.php" method="post">
        <fieldset>
            <legend>Delete Product</legend>
            <div>
                <table>
                    <tr>
                        <td><label for="ID">ID</label></td>
                        <td>: <?php echo isset($messages['data']['id']) ? $messages['data']['id'] : ""; ?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><label for="name">Name</label></td>
                        <td>: <?php echo isset($messages['data']['name']) ? $messages['data']['name'] : ""; ?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><label for="buyingprice">Buying Price</label></td>
                        <td>: <?php echo isset($messages['data']['buyingprice']) ? $messages['data']['buyingprice'] : ""; ?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><label for="sellingprice">Selling Price</label></td>
                        <td>: <?php echo isset($messages['data']['sellingprice']) ? $messages['data']['sellingprice'] : ""; ?></td>
                    </tr>
                </table>
                <hr>
            </div>
            <div>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <input type="submit" name="deleteproduct" value="Submit">

                <?php if (isset($messages['success']) && !empty($messages['success'])) : ?>

                    <span class="success"><?php echo $messages['success']; ?></span>

                <?php elseif (isset($messages['unsuccess']) && !empty($messages['unsuccess'])) : ?>

                    <span class="error"><?php echo $messages['unsuccess']; ?></span>

                <?php endif; ?>
            </div>
        </fieldset>
    </form>
</body>

</html>