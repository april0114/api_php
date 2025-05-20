<?php
function yck_send_to_api($data) {
    //실제 배포 서버용 url
    //$url = 'https://www.koreaesim.com:8443/mallapi/extern/yck/prod/yck_orders';
    //테스트 용
    $url = 'https://yconnectkorea.com/wp-content/plugins/yck-order-handler/includes/api_esim_test.php';


    $headers = [
        //"Content-Type: application/json; charset=UTF-8",
        "client_id: yck_esim",
        "client_secret: D17F354C6986F735B0C47DE69E74560D42FCBDE421AA632794697176FD3F5AE2"
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
