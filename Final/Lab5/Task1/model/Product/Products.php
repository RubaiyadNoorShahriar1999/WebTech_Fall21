<?php

function addProduct(Product $product)
{
    $query = "INSERT INTO products (p_name, p_bp, p_sp) VALUES (:p_name, :p_bp, :p_sp)";

    return execute(
        $query,
        [
            ":p_name"   => $product->getName(),
            ":p_bp"     => $product->getBuyingPrice(),
            ":p_sp"     => $product->getSellingPrice(),
        ]
    );
}

function editProduct(Product $product)
{
    $query = "UPDATE products SET p_name = :p_name, p_bp = :p_bp, p_sp = :p_sp WHERE p_id = :p_id";

    return execute(
        $query,
        [
            ":p_name"   => $product->getName(),
            ":p_bp"     => $product->getBuyingPrice(),
            ":p_sp"     => $product->getSellingPrice(),
            ":p_id"     => $product->getId(),
        ]
    );
}

function getAllProduct($search = "")
{
    $query = "SELECT * FROM products";

    if (!empty($search)) {

        $query .= " WHERE p_name LIKE :search";

        return get($query, [
            ":search" => "%$search%",
        ]);
    }

    return get($query);
}

function getProduct(int $id)
{
    $query = "SELECT * FROM products WHERE p_id = :p_id";
    $results = get($query, [
        ":p_id" => $id
    ]);

    if (count($results)) {
        return $results[0];
    }

    return false;
}

function deleteProduct(int $product_id)
{
    $query = "DELETE FROM products WHERE p_id = :p_id";

    return execute(
        $query,
        [
            ":p_id"     => $product_id,
        ]
    );
}

// echo '<pre>';
// var_dump(deleteProduct(2));
// echo '</pre>';
// exit;

// function showAllStudents()
// {
//     $conn = db_conn();
//     $selectQuery = 'SELECT * FROM `user_info` ';
//     try {
//         $stmt = $conn->query($selectQuery);
//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     }
//     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     return $rows;
// }

// function showStudent($id)
// {
//     $conn = db_conn();
//     $selectQuery = "SELECT * FROM `user_info` where ID = ?";

//     try {
//         $stmt = $conn->prepare($selectQuery);
//         $stmt->execute([$id]);
//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     }
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);

//     return $row;
// }

// function searchUser($user_name)
// {
//     $conn = db_conn();
//     $selectQuery = "SELECT * FROM `user_info` WHERE Username LIKE '%$user_name%'";


//     try {
//         $stmt = $conn->query($selectQuery);
//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     }
//     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     return $rows;
// }


// function addStudent($data)
// {
//     $conn = db_conn();
//     $selectQuery = "INSERT into user_info (Name, Surname, Username, Password, image)
// VALUES (:name, :surname, :username, :password, :image)";
//     try {
//         $stmt = $conn->prepare($selectQuery);
//         $stmt->execute([
//             ':name' => $data['name'],
//             ':surname' => $data['surname'],
//             ':username' => $data['username'],
//             ':password' => $data['password'],
//             ':image' => $data['image']
//         ]);
//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     }

//     $conn = null;
//     return true;
// }


// function updateStudent($id, $data)
// {
//     $conn = db_conn();
//     $selectQuery = "UPDATE user_info set Name = ?, Surname = ?, Username = ? where ID = ?";
//     try {
//         $stmt = $conn->prepare($selectQuery);
//         $stmt->execute([
//             $data['name'], $data['surname'], $data['username'], $id
//         ]);
//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     }

//     $conn = null;
//     return true;
// }

// function deleteStudent($id)
// {
//     $conn = db_conn();
//     $selectQuery = "DELETE FROM `user_info` WHERE `ID` = ?";
//     try {
//         $stmt = $conn->prepare($selectQuery);
//         $stmt->execute([$id]);
//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     }
//     $conn = null;

//     return true;
// }
