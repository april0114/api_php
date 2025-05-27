<?php
require_once plugin_dir_path(__FILE__) . '/utils.php';
require_once plugin_dir_path(__FILE__) . '/api_usim.php';

function yck_handle_usim_order($order) {
    // 상품의 slug 기반 언어 결정
    $slug = '';
    foreach ($order->get_items() as $item) {
        $slug = $item->get_product()->get_slug();
        break;
    }
    $lang = str_starts_with($slug, 'en_') ? 'en' : 'ko';

    $data = yck_collect_order_data($order, 'usim');

    error_log('[YCK] 최종 buy_user_name: [' . $data['first_name'] . ' ' . $data['last_name'] . ']');
    error_log('[YCK] JSON 최종 전송값: ' . json_encode($data, JSON_UNESCAPED_UNICODE));

    $api_response = yck_send_to_api($data, 'usim'); // usim API 호출

    // 템플릿 및 제목
    $template_file    = "templates/email_template_usim_{$lang}.php";
    $template_path    = plugin_dir_path(__DIR__) . $template_file;
    $subject_customer = $lang === 'en' ? '[Y CONNECT KOREA] USIM Voucher' : '[Y CONNECT KOREA] USIM 바우처';

    // [1] API 정상 응답
    if ($api_response['result'] === 0) {
        $email_body = yck_render_template($template_path, ['mail_data' => $data]);
        $sent = wp_mail($data['email'], $subject_customer, $email_body, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <noreply@yconnectkorea.com>',
        ]);
        error_log($sent ? '[YCK] ✅ USIM 이메일 전송 성공' : '[YCK] ❌ USIM 이메일 전송 실패');
    }

    // [2] API 실패이지만 결제 성공 (-9)
    elseif ($api_response['result'] === -9) {
        $email_body_user = yck_render_template($template_path, ['mail_data' => $data]);
        wp_mail($data['email'], $subject_customer, $email_body_user, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <noreply@yconnectkorea.com>',
        ]);

        $admin_template = plugin_dir_path(__DIR__) . '/templates/error/error_alert.php';
        $email_body_admin = yck_render_template($admin_template, ['mail_data' => $data]);
        wp_mail('noreply@yconnectkorea.com', '[YCK 알림] USIM 주문 API 실패(-9) - 수동 등록 필요', $email_body_admin, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
        ]);
    }

    // [3] 명시적 에러코드 대응
    elseif (in_array($api_response['result'], [-1, -2, -3, -4])) {
        $admin_template = plugin_dir_path(__DIR__) . '/templates/error/error_alert.php';
        $email_body_admin = yck_render_template($admin_template, [
            'mail_data' => $data,
            'error_code' => $api_response['result'],
            'error_reason' => $api_response['reason'] ?? 'Unknown',
        ]);

        wp_mail('noreply@yconnectkorea.com', "[YCK 경고] USIM 주문 API 실패 (코드: {$api_response['result']})", $email_body_admin, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
        ]);

        error_log('[YCK] 관리자에게 에러코드 ' . $api_response['result'] . ' 메일 전송됨');
    }

    // [4] 기타 실패
    else {
        error_log('[YCK] USIM API 실패: ' . json_encode($api_response));
    }
}
