<?php
date_default_timezone_set('Asia/Seoul');// 한국 시간 기준
header("Content-Type: application/json");

// 환경변수 및 모듈 로딩
require_once(__DIR__ . "/../../../../includes/core/env_loader.php");
require_once(__DIR__ . "/../../../../includes/core/db.php");
require_once(__DIR__ . "/../../../../includes/logic/validate.php");
require_once(__DIR__ . "/../../../../includes/logic/send_api.php");
require_once(__DIR__ . "/../../../../includes/logic/insert.php");
require_once(__DIR__ . "/../../../../includes/utils/notify_admin.php");
require_once(__DIR__ . "/../../../../includes/utils/mail_send.php");

// HTTP 헤더 수동 파싱
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

// 🔽 1. 입력
$headers = get_request_headers();
$clientId = $headers['client-id'] ?? null;
$clientSecret = $headers['client-secret'] ?? null;

$input = json_decode(file_get_contents("php://input"), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(["result" => -2, "reason" => "Invalid JSON input"]);
    exit;
}

// 🔽 2. 인증
if (
    $clientId !== getenv('API_CLIENT_ID') ||
    $clientSecret !== getenv('API_CLIENT_SECRET')
) {
    http_response_code(401);
    echo json_encode([
        "result" => -1,
        "reason" => "missing or invalid client_id or client_secret in HTTP Header"
    ]);
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

// apply_end_date 계산(도착일 + 일수 - 1)
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

// 🔽 6.5. 메일 발송 (pickup voucher 이메일 전송)
// 메일에 보낼 정보 준비
$order_info = [
    'order_id' => $order_id,
    'last_name' => $data['last_name'],
    'first_name' => $data['first_name'],
    'mobile_number' => $data['mobile_number'],
    'mobile_model' => $data['device_model'],
    'arrival_date' => $data['arrival_date'],
    'pickup_location' => $data['pickup_location'] ?? 'Incheon International Airport (Terminal 1)', // 없으면 기본값
    'usage_days' => $data['product_days']
];

// 메일 보내기
sendPickupVoucherEmail($data['email'], $order_info);

// 🔽 7. 응답
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
