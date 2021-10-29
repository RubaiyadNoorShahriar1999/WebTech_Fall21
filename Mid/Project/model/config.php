<?php

/**
 * Can't access directly by URL
 */

defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");

return [
    "APP_NAME"      => "Mid/" . basename(dirname(dirname(__FILE__))),
    // "THEME_COLOR"   => ["success", "danger", "warning", "info", "dark"][rand(0,4)],
    "THEME_COLOR"   => "success",
    "EXPIRED"       => 60 * 60 * 24 * 7,    // 60 * 60 * 24 * 7 = 7 days
    "SERVER_NAME"   => "localhost",
    "UPLOAD_DIR"    => "assets/uploads/",
    "DB_DIR"        => dirname(dirname(__FILE__)) . "/model/users.json",
    "DB_NAME"       => "",
    "DB_USERNAME"   => "root",
    "DB_PASSWORD"   => ""
];
