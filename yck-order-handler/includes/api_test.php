<?php
define('VALID_CLIENT_ID', 'yck_esim');
define('VALID_CLIENT_SECRET', 'D17F354C6986F735B0C47DE69E74560D42FCBDE421AA632794697176FD3F5AE2');

// 🔽 헤더 추출
function get_request_headers() {
    $headers = [];
    foreach ($_SERVER as $key => $value) {
        if (strpos($key, 'HTTP_') === 0) {
            $header = str_replace('_', '-', strtolower(substr($key, 5)));
            $headers[$header] = $value;
        }
    }
    return $headers;
}

// 🔽 1. 인증 검사
$headers = get_request_headers();
$clientId = $headers['client-id'] ?? null;
$clientSecret = $headers['client-secret'] ?? null;

if (!$clientId || !$clientSecret) {
    http_response_code(400);
    echo json_encode(["result" => -1, "reason" => "missing client-id or client-secret"]);
    exit;
}

if ($clientId !== VALID_CLIENT_ID || $clientSecret !== VALID_CLIENT_SECRET) {
    http_response_code(401);
    echo json_encode(["result" => -1, "reason" => "invalid client-id or client-secret"]);
    exit;
}

// 🔽 2. JSON 파싱
$input = json_decode(file_get_contents("php://input"), true);
if (!$input || !is_array($input)) {
    http_response_code(400);
    echo json_encode(["result" => -2, "reason" => "invalid JSON input"]);
    exit;
}

// 🔽 3. 필수 필드 검사
$required_fields = ['order_id', 'buy_user_name', 'buy_user_email', 'esim_day'];

foreach ($required_fields as $field) {
        http_response_code(400);
    if (empty($input[$field])) {
        echo json_encode(["result" => -2, "reason" => $field]);
        exit;
    }
}


// 🔽 4. esim_day 유효성 검사 (허용된 값만)
// $allowed_days = [1, 3, 5, 10, 20, 30];
// $esim_day = $input['esim_day'];

// // 허용된 값인지 검사
// if (!in_array($esim_day, $allowed_days, true)) {
//     http_response_code(400);
//     echo json_encode(["result" => -3, "reason" => "esim_day"]);
//     exit;
// }

// 🔽 5. 중복 order_id 검사 예시 (나중에 DB 연결 시 사용 가능)
// if (check_order_exists($input['order_id'])) {
//     echo json_encode(["result" => -4, "reason" => "duplicated order_id"]);
//     exit;
// }

// 🔽 6. 성공
echo json_encode([
    "result" => 0,
    "received" => $input
]);
exit;
