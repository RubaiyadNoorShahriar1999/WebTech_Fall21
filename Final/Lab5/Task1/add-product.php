<?php

session_start();

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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lab 5 Task 1 | Add Product</title>

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
    <form action="./controller/AddProduct.php" method="post">
        <fieldset>
            <legend>Add Product</legend>
            <div>
                <table>
                    <tr>
                        <td><label for="name">Name</label></td>
                        <td>:<input type="text" name="name" id="name" value="<?php echo isset($messages['data']['name']) ? $messages['data']['name'] : ""; ?>"></td>
                        <td class="error"><?php echo isset($messages['errors']['name']) ? $messages['errors']['name'] : ""; ?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><label for="buyingprice">Buying Price</label></td>
                        <td>:<input type="text" name="buyingprice" id="buyingprice" value="<?php echo isset($messages['data']['buyingprice']) ? $messages['data']['buyingprice'] : ""; ?>"></td>
                        <td class="error"><?php echo isset($messages['errors']['buyingprice']) ? $messages['errors']['buyingprice'] : ""; ?></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><label for="sellingprice">Selling Price</label></td>
                        <td>:<input type="text" name="sellingprice" id="sellingprice" value="<?php echo isset($messages['data']['sellingprice']) ? $messages['data']['sellingprice'] : ""; ?>"></td>
                        <td class="error"><?php echo isset($messages['errors']['sellingprice']) ? $messages['errors']['sellingprice'] : ""; ?></td>
                    </tr>
                </table>
                <hr>
                <table>
                    <tr>
                        <td></td>
                        <td><input type="checkbox" name="display" id="display" <?php echo isset($messages['data']['display']) && $messages['data']['display'] == "on" ? " checked" : ""; ?>><label for="display">Display</label></td>
                        <td class="error"><?php echo isset($messages['errors']['display']) ? $messages['errors']['display'] : ""; ?></td>
                    </tr>
                </table>
                <hr>
            </div>
            <div>
                <input type="submit" name="addproduct" value="Submit">

                <?php if (isset($messages['success'])) : ?>

                    <span class="success"><?php echo $messages['success']; ?></span>

                <?php elseif (isset($messages['unsuccess'])) : ?>

                    <span class="error"><?php echo $messages['unsuccess']; ?></span>

                <?php endif; ?>
            </div>
        </fieldset>
    </form>
</body>

</html>