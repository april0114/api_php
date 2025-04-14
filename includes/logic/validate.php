<?php
function validate_input($input) {
    //사용자에게 입력받는 값들 검증하기 (사용자이름, 이메일, 이심 날짜들)
    $required = ['buy_user_name', 'buy_user_email', 'product_days', 'apply_start_date'];
    foreach ($required as $field) {
        if (empty($input[$field])) {
            return ["result" => -2, "reason" => "$field is missing or empty"];
        }
    }

    $valid_days = ["2","3","4","5","6","7","8","9","10","15","20","30","60","90"];
    if (!in_array((string)$input['product_days'], $valid_days)) {
        return ["result" => -3, "reason" => "invalid product_days"];
    }

    return ["result" => 0, "data" => [
        "buy_user_name" => strtoupper(trim($input['buy_user_name'])),
        "buy_user_email" => trim($input['buy_user_email']),
        "product_days" => (string)$input['product_days'],
        "apply_start_date" => trim($input['apply_start_date']),
        "product_type" => "US"
    ]];
}
