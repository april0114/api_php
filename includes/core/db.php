<?php
function get_db_connection() {
//db연동
    $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
    if ($conn->connect_error) {
        http_response_code(500);
        //db연동 실패시 -9 리턴하기
        echo json_encode(["result" => -9, "reason" => "db_connect"]);
        exit;
    }
    return $conn;
}
