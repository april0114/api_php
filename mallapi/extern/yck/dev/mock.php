<?php
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);

file_put_contents(__DIR__ . '/mock_log.txt', print_r($input, true), FILE_APPEND);

echo json_encode([
    "result" => 0,외부 API simulated response"
]);
