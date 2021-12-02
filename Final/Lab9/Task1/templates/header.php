<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");
?>
<?php function header_page($title = "") { ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lab 9 Task 1<?php echo (!empty($title)) ? " | " . $title : ""; ?></title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php } ?>