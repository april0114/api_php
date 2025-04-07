<?php
//

header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);

// 로그 찍기
file_put_contents(__DIR__ . '/api_log.txt', print_r($input, true), FILE_APPEND);

// 실제 외부 서버처럼 응답하기
echo json_encode([
    "result" => 0
]);
