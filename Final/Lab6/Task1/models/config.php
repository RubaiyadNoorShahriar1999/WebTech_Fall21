<?php

/**
 * Can't access directly by URL
 */

// defined("_DIRECT_ACCESS") or exit("<h1>Your are not allowed</h1>");

return [
    "SERVER_NAME"   => "localhost",
    "DB_NAME"       => "lab6task1",
    "DB_USERNAME"   => "root",
    "DB_PASSWORD"   => "",
    "UPLOAD_DIR"    => "models/uploads/",
    "EXPIRED"       => 60 * 60 * 24 * 7,    // 60 * 60 * 24 * 7 = 7 days
];