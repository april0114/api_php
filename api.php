<?php
// /esim-api/api.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header('Content-Type: application/json');

require_once __DIR__ . '/load_env.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/validate.php';
require_once __DIR__ . '/includes/insert.php';
require_once __DIR__ . '/includes/send_api.php';
require_once __DIR__ . '/includes/notify_admin.php';
require_once __DIR__ . '/includes/response.php';

load_env(__DIR__ . '/.env');

// 1. POST 요청만 허용
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["result" => -2, "reason" => "method_not_allowed"]);
    exit;
}

// 2. 허용된 엔드포인트 검사
$uri = $_SERVER['REQUEST_URI'];
$allowed_endpoints = [
    '/mallapi/extern/yck/dev/yck_esim',
    '/mallapi/extern/yck/prod/yck_esim'
];

$matched = false;
foreach ($allowed_endpoints as $endpoint) {
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

// 3. 인증 검사
$conn = get_db_connection();
check_api_auth($conn);

// 4. JSON 파싱
$input = json_decode(file_get_contents("php://input"), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(["result" => -2, "reason" => "invalid_json"]);
    exit;
}

// 5. 입력 유효성 검사 (필수값, eSIM 유효성)
$data = validate_input($input);

// 6. 외부 API 전송 전 order_id 및 payment_date 생성
$order_id = "ORD_" . date("YmdHis");
$payment_date = date("YmdHis");

// 7. 외부 API 전송
$response = send_to_external_api($data, $order_id, $payment_date);

// 8. 외부 API 실패 (-9) → 메일만 보내고 사용자에겐 성공처럼 응답, DB 저장 안함
if (isset($response['result']) && $response['result'] === -9) {
    $admin_message = "외부 API 전송 실패 (-9)\n\n"
        . "Order ID: $order_id\n"
        . "사용자: {$data['buy_user_name']} ({$data['buy_user_email']})\n"
        . "eSIM: " . json_encode($data['esim_day']) . "\n"
        . "응답: " . print_r($response, true);

    notify_admin("eSIM API 전송 실패", $admin_message);

    echo json_encode([
        "result" => 0,
        "order_id" => $order_id
    ]);
    exit;
}

// 9. 외부 API 응답이 실패지만 -9가 아님 → 사용자에게 그대로 오류 전달 (DB 저장 X)
if (!isset($response['result']) || $response['result'] !== 0) {
    http_response_code(500);
    echo json_encode([
        "result" => $response['result'] ?? -9,
        "reason" => $response['reason'] ?? "external_api_error"
    ]);
    exit;
}

// 10. 외부 API까지 성공했을 때만 → DB 저장
insert_esim_order($conn, $data, $order_id, $payment_date);
$conn->close();

// 11. 사용자에게 성공 응답
success_response($order_id);
