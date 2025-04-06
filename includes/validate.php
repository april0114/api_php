<?php
function validate_input($input) {
    $required = ['buy_user_name', 'buy_user_email', 'esim_day'];
    foreach ($required as $field) {
        if (!isset($input[$field]) || (is_string($input[$field]) && trim($input[$field]) === '') || (is_array($input[$field]) && count($input[$field]) === 0)) {
            echo json_encode(["result" => -2, "reason" => $field]);
            exit;
        }
    }

    $valid_options = ['1', '3', '5', '10', '20', '30'];
    foreach ($input['esim_day'] as $day) {
        if (!in_array((string)$day, $valid_options, true)) {
            echo json_encode(["result" => -3, "reason" => "esim_day"]);
            exit;
        }
    }

    return [
        'buy_user_name' => trim($input['buy_user_name']),
        'buy_user_email' => trim($input['buy_user_email']),
        'esim_day' => $input['esim_day']
    ];
}
