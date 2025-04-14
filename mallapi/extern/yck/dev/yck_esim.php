<?php
date_default_timezone_set('Asia/Seoul'); // 한국 시간 기준
header("Content-Type: application/json");

// 🔧 설정 불러오기
require_once(__DIR__ . "/../../../../includes/core/env_loader.php");
require_once(__DIR__ . "/../../../../includes/core/db.php");
require_once(__DIR__ . "/../../../../includes/logic/validate.php");
require_once(__DIR__ . "/../../../../includes/logic/send_api.php");
require_once(__DIR__ . "/../../../../includes/logic/insert.php");
require_once(__DIR__ . "/../../../../includes/utils/notify_admin.php");

// 🔽 1. 입력 데이터 받기
$input = json_decode(file_get_contents("php://input"), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(["result" => -2, "reason" => "Invalid JSON input"]);
    exit;
}

// 🔽 2. 헤더 인증 체크
$headers = getallheaders();
if (
    !isset($headers['client_id']) || $headers['client_id'] !== getenv('API_CLIENT_ID') ||
    !isset($headers['client_secret']) || $headers['client_secret'] !== getenv('API_CLIENT_SECRET')
) {
    http_response_code(401);
    echo json_encode(["result" => -1, "reason" => "missing or invalid client_id or client_secret in HTTP Header"]);
    exit;
}

// 🔽 3. 유효성 검사
$validation = validate_input($input);
if ($validation['result'] !== 0) {
    echo json_encode($validation);
    exit;
}
$data = $validation['data'];

// 🔽 4. 자동 생성 필드
$order_date = date('ymd'); // YYMMDD
$unique = strtoupper(substr(md5(uniqid()), 0, 6));
$order_id = "YCK{$order_date}AA{$unique}";
$payment_date = date('Ymd'); // 미국 기준 날짜 (UTC 고려 시 처리 필요)

// apply_end_date 계산 (도착일 + 일수 - 1)
$start = DateTime::createFromFormat('Ymd', $data['apply_start_date']);
$start->modify('+' . ((int)$data['product_days'] - 1) . ' days');
$apply_end_date = $start->format('Ymd');

// 🔽 5. 외부 API 전송
$response = send_to_external_api($data, $order_id, $payment_date, $apply_end_date);
if ($response['result'] !== 0) {
    notify_admin("외부 API 실패", json_encode($response));
    http_response_code(502); // Bad Gateway
    echo json_encode([
        "result" => -9,
        "reason" => "external api failed",
        "external_response" => $response
    ]);
    exit;
}

// 🔽 6. DB 저장
$conn = get_db_connection();
insert_esim_order($conn, $data, $order_id, $payment_date, $apply_end_date);
$conn->close();

// 🔽 7. 전체 응답 반환
echo json_encode([
    "result" => 0,
    "message" => "Order processed successfully",
    "input" => $input,
    "generated" => [
        "order_id" => $order_id,
        "payment_date" => $payment_date,
        "apply_end_date" => $apply_end_date
    ],
    "external_response" => $response
]);
exit;
