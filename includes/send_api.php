<?php
function send_to_external_api($data, $order_id, $payment_date) {
    // 외부 API 주소 설정 (운영 환경 주소로 변경 가능)
    $url = "http://localhost/esim-api/includes/receive.php";

    // HTTP 헤더 구성 (실제 client_id/secret은 필요 시 외부용으로 별도 설정 가능)
    $headers = [
        "Content-Type: application/json; charset=UTF-8",
        "client_id: " . getenv('API_CLIENT_ID'),
        "client_secret: " . getenv('API_CLIENT_SECRET')
    ];

    // 요청 바디 구성
    $body = json_encode([
        "order_id" => $order_id,
        "buy_user_name" => $data['buy_user_name'],
        "buy_user_email" => $data['buy_user_email'],
        "esim_day" => $data['esim_day'],
        "payment_date" => $payment_date
    ]);

    // curl 요청 설정
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // 타임아웃 설정 (초)

    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    // 실패 시 curl 에러 반환
    if ($error) {
        return [
            "result" => -9,
            "reason" => "curl_error",
            "message" => $error
        ];
    }

    // JSON 응답 디코딩
    $decoded = json_decode($response, true);
    return $decoded ?: [
        "result" => -9,
        "reason" => "invalid_json_from_external",
        "raw_response" => $response
    ];
}
