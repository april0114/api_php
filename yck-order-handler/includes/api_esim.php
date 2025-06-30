<?php

function yck_send_to_api($data) {
    $timestamp = date('[Y-m-d H:i:s]');

    //실제 배포 서버용 url

    //테스트 용
    $url = '';


    $headers = [
        "Content-Type: application/json; charset=UTF-8",
        "client_id: ",
        "client_secret: abcdefg(it's a secret)"
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

    error_log("$timestamp [YCK] API 전송 바디: " . $body . PHP_EOL, 3, __DIR__ . '/error/error.log');

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // ✅ HTTP 응답 코드
    curl_close($ch);

    //error_log("$timestamp [YCK] API 응답 코드: $http_code" . PHP_EOL, 3, __DIR__ . '/error/error.log');
    //error_log("$timestamp [YCK] API 응답 RAW: $response" . PHP_EOL, 3, __DIR__ . '/error/error.log');

    $json = json_decode($response, true);

    error_log("$timestamp [YCK] API 응답 파싱 결과: " . json_encode($json, JSON_UNESCAPED_UNICODE) . PHP_EOL, 3, __DIR__ . '/error/error.log');

    return $json;
}
