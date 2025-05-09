<?php
function yck_send_to_api($data) {
    $url = '이것은 비밀입니다 endpoint각자꺼 넣으세용^^b';

    $headers = [
        "Content-Type: application/json",
        "client_id: yck_esim",
        "client_secret: secret도 비밀입니다용"
    ];
    
    $buy_user_name = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));

    // ✅ 필요한 필드만 추려서 전송
    $body = json_encode([
        "order_id"        => $data['order_id'],
        "buy_user_name"   => $buy_user_name,
        "buy_user_email"  => $data['email'],
        "esim_day"        => $data['usage_days'],
        "payment_date"    => $data['payment_date'],
    ]);

    error_log('[YCK] API 전송 바디: ' . $body);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // ✅ HTTP 응답 코드
    curl_close($ch);

    error_log("[YCK] API 응답 코드: $http_code");
    error_log("[YCK] API 응답 RAW: $response");

    $json = json_decode($response, true);

    if ($json === null) {
        error_log('[YCK] API 응답 JSON 파싱 실패');
        return ['result' => -9, 'error' => 'Invalid API response'];
    }

    error_log('[YCK] API 응답 파싱 결과: ' . json_encode($json));
    return $json;
}
