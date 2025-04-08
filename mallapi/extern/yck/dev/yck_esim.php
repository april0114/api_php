<?php
date_default_timezone_set('Asia/Seoul'); //한국 시간 기준으로 생성
header("Content-Type: application/json");

//경로 호출
require_once(__DIR__ . "/../../../../includes/core/env_loader.php");
require_once(__DIR__ . "/../../../../includes/core/db.php");
require_once(__DIR__ . "/../../../../includes/logic/validate.php");
require_once(__DIR__ . "/../../../../includes/logic/send_api.php");
require_once(__DIR__ . "/../../../../includes/logic/insert.php");
require_once(__DIR__ . "/../../../../includes/utils/notify_admin.php");


//🔽 1. 입력받기
$input = json_decode(file_get_contents("php://input"), true);
//임시로 order_id생성 
$order_id = 'YCK' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 6));
//결제 날짜 오늘 날짜로 생성
$payment_date = date('YmdHis');
//헤더값 가져오기
$headers = getallheaders();
//헤더값이 누락되어있을 경우
if (
    !isset($headers['client_id']) || $headers['client_id'] !== getenv('client_id') ||
    !isset($headers['client_secret']) || $headers['client_secret'] !== getenv('client_secret')
) {
    http_response_code(401);
    echo json_encode(["result" => -1, "description" => "missing or invalid client_id or client_secret in HTTP Header"]);
    exit;
}

//POST에서 결과값이 0이 아닐 경우 에러값 리턴해주기
$validation = validate_input($input);
if ($validation['result'] !== 0) {
    echo json_encode($validation);
    exit;
}
// 🔽 2. 유효성 검사
$data = $validation['data'];

// 🔽 3. 외부 API 전송
$response = send_to_external_api($data, $order_id, $payment_date);
if ($response['result'] !== 0) {
    notify_admin("외부 API 실패", json_encode($response));
}

$conn = get_db_connection();
insert_esim_order($conn, $data, $order_id, $payment_date);
$conn->close();

echo json_encode([
    "result" => 0,
    "order_id" => $order_id,
    "buy_user_name" => $data['buy_user_name'],
    "buy_user_email" => $data['buy_user_email'],
    "esim_day" => $data['esim_day'],
    "payment_date" => $payment_date
]);
exit;
