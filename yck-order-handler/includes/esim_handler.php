<?php
require_once plugin_dir_path(__FILE__) . '/utils.php';
require_once plugin_dir_path(__FILE__) . '/api_esim.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

function yck_handle_esim_order($order, $lang = 'ko') {
    $data = yck_collect_order_data($order, 'esim');
    
    error_log('[YCK] 최종 buy_user_name: [' . $data['first_name'] . ' ' . $data['last_name'] . ']');
    error_log('[YCK] JSON 최종 전송값: ' . json_encode($data));

    $api_response = yck_send_to_api($data);

    // 언어별 설정
    $template_file    = "templates/email_template_esim_{$lang}.php";
    $template_path    = plugin_dir_path(__DIR__) . $template_file;
    
    error_log('[YCK] 템플릿 경로: ' . $template_path);

    $subject_customer = $lang === 'en' ? '[Y CONNECT KOREA] eSIM Voucher' : '[Y CONNECT KOREA] eSIM 바우처';

    // [1] API 정상 응답
    if ($api_response['result'] === 0) {
        $email_body = yck_render_template($template_path, ['mail_data' => $data]);

        wp_mail($data['email'], $subject_customer, $email_body, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <noreply@yconnectkorea.com>', 
        ]);
    } 
    
    // [2] API 실패 (-9), 결제는 성공한 경우
    elseif ($api_response['result'] === -9) {
        // 사용자에게는 정상처럼 바우처 전송
        $email_body_user = yck_render_template($template_path, ['mail_data' => $data]);

        wp_mail($data['email'], $subject_customer, $email_body_user, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <noreply@yconnectkorea.com>',
        ]);

        // 관리자에게 경고 메일
        $admin_template = plugin_dir_path(__DIR__) . '/templates/error/error_alert.php';
        $email_body_admin = yck_render_template($admin_template, ['mail_data' => $data]);

        wp_mail('noreply@yconnectkorea.com', '[YCK 알림] ESIM 주문 API 실패 - 수동 등록 필요', $email_body_admin, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
        ]);
    } 
    
    else {
        error_log('[YCK] eSIM API 실패: ' . json_encode($api_response));
    }
}
