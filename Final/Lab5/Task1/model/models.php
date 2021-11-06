<?php

function db_conn()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lab5task1";
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";

    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // var_dump($conn) ;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $conn;
}

// Responsible for running insert,update,delete
function execute($query, $bindparams = [])
{
    $conn = db_conn();
    $is_success = false;

    if ($conn) {
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute($bindparams);

            $is_success = $stmt->rowCount() > 0 ? true : false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            $is_success = false;
        }
    }

    $conn = null;

    return $is_success;
}

// Responsible for running select queires
function get($query, $bindparams = [])
{
    $conn = db_conn();
    $results = array();

    if ($conn) {
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute($bindparams);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    $conn = null;

    return $results;
}

// echo '<pre>';
// var_dump(get("SELECT * FROM products WHERE p_name LIKE :search", [':search' => '%nge%']));
// echo '</pre>';
// exit;

require_once "Product/Product.php";
require_once "Product/Products.php";
