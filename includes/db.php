<?php
//DB 연동 PHP
function get_db_connection() {
    $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(["result" => -9, "reason" => "db_connect"]);
        exit;
    }
    return $conn;
}
