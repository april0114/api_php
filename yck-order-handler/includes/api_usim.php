<?php
function yck_send_usim_to_api($data)
{
    //실제 서버 (배포용)


    //테스트용
    $url = 'https://yconnectkorea.com/wp-content/plugins/yck-order-handler/includes/api_usim_test.php';


    $headers = [
        //"Content-Type: application/json; charset=UTF-8",
    ];

    $buy_user_name = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));
    $product_days = is_array($data['usage_days']) ? (string) ($data['usage_days'][0] ?? '1') : (string) $data['usage_days'];
    $today = date('Ymd');


    // ✅ API에 전송할 본문 데이터 구성
    $body = json_encode([
        "order_id" => $data['order_id'],
        "buy_user_name" => $buy_user_name,
        "product_type" => "US",       
        "product_days" => $product_days,
        "quantity" => 1,            
        "apply_start_date" => $today, 
        "payment_date" => $today
    ]);

    error_log('[YCK-USIM] API 전송 바디: ' . $body);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    error_log("[YCK-USIM] API 응답 코드: $http_code");
    error_log("[YCK-USIM] API 응답 RAW: $response");

    $json = json_decode($response, true);

    if ($json === null) {
        error_log('[YCK-USIM] API 응답 JSON 파싱 실패');
        return ['result' => -9, 'error' => 'Invalid API response'];
    }

    error_log('[YCK-USIM] API 응답 파싱 결과: ' . json_encode($json));
    return $json;
}
