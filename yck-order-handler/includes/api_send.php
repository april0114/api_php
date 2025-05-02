<?php
function yck_send_api($data) {
    $payload = [
        'order_id' => $data['order_id'],
        'buy_user_name' => $data['name'],
        'buy_user_email' => $data['email'],
        'esim_day' => [(int)$data['esim_day']],
        'payment_date' => $data['payment_date']
    ];

    $headers = [
        'Content-Type'   => 'application/json',
        'client_id'      => $_ENV['CLIENT_ID'] ?? '',
        'client_secret'  => $_ENV['CLIENT_SECRET'] ?? ''
    ];

    if (empty($headers['client_id']) || empty($headers['client_secret'])) {
        error_log('[YCK] API 키 또는 시크릿이 누락되었습니다. .env 파일을 확인하세요.');
        return;
    }

    $response = wp_remote_post('https://www.koreaesim.com:8443/mallapi/extern/yck/prod/yck_orders', [
        'method'    => 'POST',
        'headers'   => $headers,
        'body'      => json_encode($payload),
        'timeout'   => 10
    ]);

    if (is_wp_error($response)) {
        error_log('[YCK] API 전송 실패: ' . $response->get_error_message());
    } else {
        $res = json_decode(wp_remote_retrieve_body($response), true);
        error_log('[YCK] API 응답: ' . print_r($res, true));
    }
}
