<?php
header("Content-Type: application/json");

// 입력 데이터 확인용 로그 저장
$input = json_decode(file_get_contents("php://input"), true);
file_put_contents(__DIR__ . '/mock_log.txt', print_r($input, true), FILE_APPEND);

// 정상 응답 반환
echo json_encode([
    "result" => 0,
    "message" => "외부 API simulated response"
]);
