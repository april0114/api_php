<?php
function yck_send_usim_to_api($data) {
    $timestamp = date('[Y-m-d H:i:s]');

    // ✅ 실제 운영 서버 API 주소
    
    //테스트용
    $url = '';


    $headers = [
        "Content-Type: application/json; charset=UTF-8",
        "client_id: ",
        "client_secret: abcdefg(it's a secret)"
    ];

    $buy_user_name = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
    $product_days = is_array($data['usage_days']) ? (string)($data['usage_days'][0] ?? '1') : (string)$data['usage_days'];
    $today = date('Ymd');


    // ✅ API에 전송할 본문 데이터 구성
    $body = json_encode([
        "order_id"         => $data['order_id'],
        "buy_user_name"    => $buy_user_name,
        "product_type"     => "US",         
        "product_days"     => $product_days,
        "quantity"         => 1,            
        "apply_start_date" => str_replace('-', '', $data['arrival_date']),
        "payment_date"     => $today
    ]);

    error_log("$timestamp [YCK] API 전송 바디: " . $body . PHP_EOL, 3, __DIR__ . '/error/error.log');

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    //error_log("$timestamp [YCK] API 응답 코드: $http_code" . PHP_EOL, 3, __DIR__ . '/error/error.log');
    //error_log("$timestamp [YCK] API 응답 RAW: $response" . PHP_EOL, 3, __DIR__ . '/error/error.log');

    $json = json_decode($response, true);

    error_log("$timestamp [YCK] API 응답 파싱 결과: " . json_encode($json, JSON_UNESCAPED_UNICODE) . PHP_EOL, 3, __DIR__ . '/error/error.log');

    return $json;
}
