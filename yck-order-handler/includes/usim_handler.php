<?php
require_once plugin_dir_path(__FILE__) . '/utils.php';
require_once plugin_dir_path(__FILE__) . '/api_client.php';

function yck_handle_usim_order($order) {
    $data = yck_collect_order_data($order);

    $api_response = yck_send_to_api($data);
    if ($api_response['result'] === 0) {
        $template = plugin_dir_path(__DIR__) . '/templates/email_template_usim.php';
        $email_body = yck_render_template($template, ['mail_data' => $data]);

        wp_mail($data['email'], '[Y CONNECT KOREA] USIM 바우처', $email_body, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <kyungrimha@gmail.com>',
        ]);
    } else {
        error_log('[YCK] USIM API 실패: ' . json_encode($api_response));
    }
}
