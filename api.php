<?php
// /esim-api/api.php

header('Content-Type: application/json');

require_once __DIR__ . '/load_env.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/validate.php';
require_once __DIR__ . '/includes/insert.php';
require_once __DIR__ . '/includes/response.php';
require_once __DIR__ . '/includes/send_api.php';
require_once __DIR__ . '/includes/notify_admin.php';

load_env(__DIR__ . '/.env');

// 엔드포인트 확인
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["result" => -2, "reason" => "method_not_allowed"]);
    exit;
}

$uri = $_SERVER['REQUEST_URI'];
// 개발 완료시에 앞에 엔드포인트 추가 koreasim.com:8843 현쟈는 localhost 로 테스트
$valid_endpoints = [
    '/mallapi/extern/yck/dev/yck_esim',
    '/mallapi/extern/yck/prod/yck_esim'
];

$matched = false;
foreach ($valid_endpoints as $endpoint) {
    if (str_contains($uri, $endpoint)) {
        $matched = true;
        break;
    }
}

if (!$matched) {
    http_response_code(404);
    echo json_encode(["result" => -2, "reason" => "invalid_endpoint"]);
    exit;
}

$conn = get_db_connection();
check_api_auth($conn);

$input = json_decode(file_get_contents("php://input"), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(["result" => -2, "reason" => "invalid_json"]);
    exit;
}

$data = validate_input($input);
$order_id = insert_esim_order($conn, $data);
$payment_date = date("YmdHis");

// 외부 API 전송 시도
$response = send_to_external_api($data, $order_id, $payment_date);

if (!$response || !isset($response['result']) || $response['result'] !== 0) {
    notify_admin("[eSIM API 전송 실패] 주문 ID: $order_id", print_r($response, true));
    echo json_encode([
        "result" => -9,
        "reason" => "external_api_failed",
        "details" => $response
    ]);
    exit;
}

$conn->close();
success_response($order_id);
