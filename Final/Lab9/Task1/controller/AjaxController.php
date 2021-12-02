<?php

/**
 * Can access direcly by URL
 */

define("_DIRECT_ACCESS", true);

$messages = [];

require_once dirname(__FILE__, 2) . "/helper/functions.php";

if (isset($_GET['email'])) {
    $has_err = false;

    $email = "";

    /**
     * For Regular Expression
     * 
     * @see https://regexr.com/69mgr
     */

    if (empty($_GET['email'])) {
        $messages['error']['email'] = "Email is required";
        $has_err = true;
    } else if (!preg_match("/^[a-zA-Z._]+[\w._]*@\w+(\.[\w._]+)+(\.[\w._])*$/", $_GET['email'])) {
        $messages['error']['email'] = "Email is not valid";
        $has_err = true;
    } else {
        $email = htmlspecialchars(trim($_GET['email']));
    }

    if (!$has_err) {
        require_once _ROOT_DIR . "models/User/UsersModel.php";

        $store_email = getUserByEmail($email);

        // _var_dump($store_email);
        // // exit;

        if (!(isset($_SESSION['email']) && $_SESSION['email'] === $email)) {
            if (isset($store_email['u_email']) && $store_email['u_email'] === $email) {
                $messages['is_duplicate'] = true;
                $messages['error']['email'] = "Email alredy registered";
            } else {
                $messages['is_duplicate'] = false;
            }
        }

        exit(json_encode($messages));
    } else {
        exit(json_encode($messages));
    }
} else {
    $messages['error']['message'] = "Invalid Request";

    exit(json_encode($messages));
}
