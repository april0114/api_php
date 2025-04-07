<?php
file_put_contents(__DIR__ . "/validate_log.txt", "🚨 validate_input 실행됨\n", FILE_APPEND);


function validate_input($input) {
    // 필수 항목 체크
    $required = ['buy_user_name', 'buy_user_email', 'esim_day'];

    foreach ($required as $field) {
        if (!isset($input[$field])) {
            http_response_code(400);
            echo json_encode(["result" => -2, "reason" => "$field is missing"]);
            exit;
        }

        // 문자열일 경우: 비어있으면 안 됨
        if (is_string($input[$field]) && trim($input[$field]) === '') {
            file_put_contents(__DIR__ . "/validate_log.txt", "❗ {$field} 비어있음: '{$input[$field]}'\n", FILE_APPEND);
            echo json_encode(["result" => -2, "reason" => "$field is empty"]);
            exit;
        }

        // 배열일 경우: 비어있거나 유효하지 않으면 안 됨
        if (is_array($input[$field]) && count($input[$field]) === 0) {
            http_response_code(400);
            echo json_encode(["result" => -2, "reason" => "$field is empty"]);
            exit;
        }
    }

    // eSIM 옵션 유효성 검사
    $valid_options = ['1', '3', '5', '10', '20', '30'];
    foreach ($input['esim_day'] as $day) {
        if (!in_array((string)$day, $valid_options, true)) {
            http_response_code(400);
            echo json_encode(["result" => -3, "reason" => "esim_day invalid"]);
            exit;
        }
    }

    // 정상일 때는 정리된 데이터 리턴
    return [
        'buy_user_name' => trim($input['buy_user_name']),
        'buy_user_email' => trim($input['buy_user_email']),
        'esim_day' => $input['esim_day']
    ];
}
