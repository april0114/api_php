<?php
function send_to_external_api($data, $order_id, $payment_date, $apply_end_date) {
    //실제 서버 배포시, env에서 보낼 api 주소로 변경하기
    $url = getenv('EXTERNAL_API_URL');
    $headers = [
        "Content-Type: application/json",
        "client_id: " . getenv('client_id'),
        "client_secret: " . getenv('client_secret')
    ];
    $body = json_encode([
        "order_id" => $order_id,
        "buy_user_name" => $data['buy_user_name'],
        "buy_user_email" => $data['buy_user_email'],
        "product_type" => $data['product_type'],
        "product_days" => $data['product_days'],
        "payment_date" => $payment_date,
        "apply_start_date" => $data['apply_start_date'],
        "apply_end_date" => $apply_end_date
    ]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        return ["result" => -9, "reason" => "curl_error", "message" => $error];
    }

    $decoded = json_decode($response, true);
    return $decoded ?: ["result" => -9, "reason" => "invalid_json_from_external"];
}
