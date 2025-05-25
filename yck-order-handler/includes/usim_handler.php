<?php
require_once plugin_dir_path(__FILE__) . '/utils.php';
require_once plugin_dir_path(__FILE__) . '/api_usim.php';

function yck_handle_usim_order($order) {
    $slug = '';
    foreach ($order->get_items() as $item) {
        $slug = $item->get_product()->get_slug();
        break;
    }

    // 언어 분기: 'en_'이면 영어, 아니면 한국어
    $lang = str_starts_with($slug, 'en_') ? 'en' : 'ko';

    $data = yck_collect_order_data($order, 'usim');

    error_log('[YCK] 최종 buy_user_name: [' . $data['first_name'] . ' ' . $data['last_name'] . ']');
    error_log('[YCK] JSON 최종 전송값: ' . json_encode($data));

    $api_response = yck_send_to_api($data, 'usim');  // usim용 API 호출

    if ($api_response['result'] === 0) {
        $template = plugin_dir_path(__DIR__) . '/templates/' .
            ($lang === 'en' ? 'email_template_usim_en.php' : 'email_template_usim.php');

        $email_body = yck_render_template($template, ['mail_data' => $data]);

        wp_mail($data['email'], '[Y CONNECT KOREA] USIM 바우처', $email_body, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <noreply@yconnectkorea.com>',
        ]);

    } elseif ($api_response['result'] === -9) {
        // 사용자용 바우처 (API 실패했지만 보여주기용)
        $template_user = plugin_dir_path(__DIR__) . '/templates/' .
            ($lang === 'en' ? 'email_template_usim_en.php' : 'email_template_usim.php');

        $email_body_user = yck_render_template($template_user, ['mail_data' => $data]);

        wp_mail($data['email'], '[Y CONNECT KOREA] USIM 바우처', $email_body_user, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <noreply@yconnectkorea.com>',
        ]);

        // 관리자에게 알림
        $template_admin = plugin_dir_path(__DIR__) . '/templates/error/error_alert.php';
        $email_body_admin = yck_render_template($template_admin, ['mail_data' => $data]);

        wp_mail('noreply@yconnectkorea.com', '[YCK 알림] USIM 주문 API 실패 - 수동 등록 필요', $email_body_admin, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
        ]);
    } else {
        error_log('[YCK] USIM API 실패: ' . json_encode($api_response));
    }
}
