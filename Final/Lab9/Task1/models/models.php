<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");
// define("_DIRECT_ACCESS", true);


require_once dirname(__FILE__, 2) . "/helper/functions.php";


function db_conn()
{
    $servername = _CONFIG['SERVER_NAME'];
    $username = _CONFIG['DB_USERNAME'];
    $password = _CONFIG['DB_PASSWORD'];;
    $dbname = _CONFIG['DB_NAME'];
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";

    $conn = null;

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
    $effected_rows = 0;

    if ($conn) {
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute($bindparams);

            $effected_rows = $stmt->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    $conn = null;

    return $effected_rows;
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

// _var_dump(execute("UPDATE users SET u_username = :username WHERE u_id = :id", [
//     ":username" => 'sasuke',
//     ':id' => 4
// ]));
// exit;

require_once _ROOT_DIR . "models/User/User.php";
