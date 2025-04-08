<?php
function validate_input($input) {
    //사용자에게 입력받는 값들 검증하기 (사용자이름, 이메일, 이심 날짜들)
    $required = ['buy_user_name', 'buy_user_email', 'esim_day'];
    foreach ($required as $field) {
        if (!isset($input[$field]) || (is_string($input[$field]) && trim($input[$field]) === '') || (is_array($input[$field]) && count($input[$field]) === 0)) {
            return ["result" => -2, "reason" => "$field is missing or empty"];
        }
    }

    $valid_options = ['1', '3', '5', '10', '20', '30'];
    $esim_day_values = is_array($input['esim_day']) ? $input['esim_day'] : [$input['esim_day']];
    foreach ($esim_day_values as $day) {
        if (!in_array((string)$day, $valid_options, true)) {
            return ["result" => -3, "reason" => "invalid esim_day: $day", "invalid value in esim product option(days)"];
        }
    }

    return [
        "result" => 0,
        "data" => [
            'buy_user_name' => trim($input['buy_user_name']),
            'buy_user_email' => trim($input['buy_user_email']),
            'esim_day' => $esim_day_values
        ]
    ];
}
