<?php

session_start();

if (!isset($_GET['searchquery']) || empty($_GET['searchquery'])) {

    require_once "./controller/ViewProduct.php";
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
    <title>Lab 5 Task 1 | View Product</title>

    <style>
        .error {
            color: red;
        }

        .success {
            color: green;
        }

        table,
        td,
        th {
            padding: 10px;
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
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
    <form action="./controller/SearchProduct.php" method="post">
        <fieldset>
            <legend>View Product</legend>
            <table>

                <tr>
                    <td colspan="4"><input type="text" name="searchquery" value="<?php echo isset($messages['searchquery']) ? $messages['searchquery'] : ""; ?>"></td>
                    <td><input type="submit" name="search" value="Search"></td>
                </tr>
                <?php if (count($messages['data']) > 0) : ?>


                    <?php if (isset($messages['errors']['searchquery']) && !empty($messages['errors']['searchquery'])) : ?>

                        <tr>
                            <td class="error" colspan="5"><?php echo $messages['errors']['searchquery']; ?></td>
                        </tr>

                    <?php endif; ?>

                    <tr>
                        <th>Name</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th colspan="2">Action</th>
                    </tr>

                <?php endif; ?>

                <?php foreach ($messages['data'] as $data) : ?>

                    <tr>
                        <td><?php echo $data['p_name'] ?></td>
                        <td><?php echo $data['p_bp'] ?></td>
                        <td><?php echo $data['p_sp'] ?></td>
                        <td><a href="edit-product.php?id=<?php echo $data['p_id'] ?>">Edit</a></td>
                        <td><a href="delete-product.php?id=<?php echo $data['p_id'] ?>">Delete</a></td>
                    </tr>

                <?php endforeach; ?>

                <?php if (isset($messages['unsuccess']) && !empty($messages['unsuccess'])) : ?>

                    <tr>
                        <td class="error" colspan="5"><?php echo $messages['unsuccess']; ?></td>
                    </tr>

                <?php endif; ?>

            </table>
        </fieldset>
    </form>
</body>

</html>