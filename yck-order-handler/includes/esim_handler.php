<?php
require_once plugin_dir_path(__FILE__) . '/utils.php';
require_once plugin_dir_path(__FILE__) . '/api_client.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

function yck_handle_esim_order($order) {
    $data = yck_collect_order_data($order);
    
    error_log('[YCK] 최종 buy_user_name: [' . $data['first_name'] . ' ' . $data['last_name'] . ']');
    error_log('[YCK] JSON 최종 전송값: ' . json_encode($data));

    $api_response = yck_send_to_api($data);
    if ($api_response['result'] === 0) {
        // 템플릿 렌더링
        $template = plugin_dir_path(__DIR__) . '/templates/email_template_esim.php';
        $email_body = yck_render_template($template, ['mail_data' => $data]);

        wp_mail($data['email'], '[Y CONNECT KOREA] eSIM 바우처', $email_body, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <kyungrimha@gmail.com>',
        ]);
    } else {
        error_log('[YCK] eSIM API 실패: ' . json_encode($api_response));
    }
}
