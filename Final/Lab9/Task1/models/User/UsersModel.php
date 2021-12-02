<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");

// define("_DIRECT_ACCESS", true);

require_once dirname(__FILE__, 3) . "/helper/functions.php";

require_once _ROOT_DIR . "models/models.php";

function addUser(User $user)
{
    $query = "INSERT INTO users(u_name, u_username, u_email, u_password, u_gender, u_dob) VALUES (:u_name, :u_username, :u_email, :u_password, :u_gender, :u_dob)";

    return execute($query, [
        ":u_name" => $user->getName(),
        ":u_username" => $user->getUsername(),
        ":u_email" => $user->getEmail(),
        ":u_password" => $user->getPassword(),
        ":u_gender" => $user->getGender(),
        ":u_dob" => $user->getDob(),
    ]);
}

function updateUser(User $user)
{
    $query = "UPDATE users SET u_name = :u_name, u_email = :u_email, u_gender = :u_gender, u_dob = :u_dob WHERE u_id = :u_id";

    return execute($query, [
        ":u_name" => $user->getName(),
        ":u_email" => $user->getEmail(),
        ":u_gender" => $user->getGender(),
        ":u_dob" => $user->getDob(),
        ":u_id" => $user->getId(),
    ]);
}

function updatePassword($newpass, $u_id)
{
    $query = "UPDATE users SET u_password = :u_password WHERE u_id = :u_id";

    return execute($query, [
        ":u_password" => $newpass,
        ":u_id" =>$u_id,
    ]);
}

function updateProfilePicture($picture, $u_id)
{
    $query = "UPDATE users SET u_pp_path = :u_pp_path WHERE u_id = :u_id";

    return execute($query, [
        ":u_pp_path" => $picture,
        ":u_id" =>$u_id,
    ]);
}

function getAllUsers()
{
    $query = "SELECT * FROM users";
    $result = [];

    $result = get($query);

    return $result;
}

function getUserById(int $u_id)
{
    $query = "SELECT * FROM users WHERE u_id = :u_id";
    $result = [];

    $result = get(
        $query,
        [
            ":u_id" => $u_id
        ]
    );

    if (count($result)) {
        return $result[0];
    }

    return false;
}

function getUserByUsername(string $u_username)
{
    $query = "SELECT * FROM users WHERE u_username = :u_username";
    $result = [];

    $result = get(
        $query,
        [
            ":u_username" => $u_username
        ]
    );

    if (count($result)) {
        return $result[0];
    }

    return false;
}

function getUserByEmail(string $u_email)
{
    $query = "SELECT * FROM users WHERE u_email = :u_email";
    $result = [];

    $result = get(
        $query,
        [
            ":u_email" => $u_email
        ]
    );

    if (count($result)) {
        return $result[0];
    }

    return false;
}

function getAuthUser(string $u_username, string $u_password)
{
    $query = "SELECT * FROM users WHERE u_username = :u_username AND u_password = :u_password";
    $result = [];

    $result = get(
        $query,
        [
            ":u_username" => $u_username,
            ":u_password" => $u_password
        ]
    );

    if (count($result)) {
        return $result[0];
    }

    return false;
}

function getRememberMeAuthUser(string $u_username, string $u_email)
{
    $query = "SELECT * FROM users WHERE u_username = :u_username AND u_email = :u_email";
    $result = [];

    $result = get(
        $query,
        [
            ":u_username" => $u_username,
            ":u_email" => $u_email
        ]
    );

    if (count($result)) {
        return $result[0];
    }

    return false;
}

function changeForgetPasswordUser(int $u_id, string $u_password)
{
    $query = "UPDATE users SET u_password = :u_password WHERE u_id = :u_id";

    return execute(
        $query,
        [
            ":u_id" => $u_id,
            ":u_password" => $u_password,
        ]
    );
}

// _print_r(getAuthUser("nobir", "asd@#123"));
// _var_dump(getAuthUser("nobir", "asd@#123"));