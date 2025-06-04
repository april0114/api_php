<?php
require_once plugin_dir_path(__FILE__) . '/utils.php';
require_once plugin_dir_path(__FILE__) . '/api_esim.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

function yck_handle_esim_order($order, $lang = 'ko')
{
    $data = yck_collect_order_data($order, 'esim');

    error_log('[YCK] JSON 최종 전송값: ' . json_encode($data));

    $api_response = yck_send_to_api($data);

    // 언어별 설정
    $template_file = "templates/email_template_esim_{$lang}.php";
    $template_path = plugin_dir_path(__DIR__) . $template_file;
    $subject_customer = $lang === 'en' ? '[Y CONNECT KOREA] This is the installation and activation guide email for the SKT eSIM you ordered' : '[Y CONNECT KOREA] This is the installation and activation guide email for the SKT eSIM you ordered';

    error_log('[YCK] 템플릿 경로: ' . $template_path);

    // [1] API 정상 응답
    if ($api_response['result'] === 0) {
        $email_body = yck_render_template($template_path, ['mail_data' => $data]);
        $sent = wp_mail($data['email'], $subject_customer, $email_body, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <noreply@yconnectkorea.com>',
        ]);

    error_log($sent ? '[YCK] ✅ 이메일 전송 성공' : '[YCK] ❌ 이메일 전송 실패');
    }
    // [2] API 실패이지만 결제 성공 (-9)
    elseif ($api_response['result'] === -9) {
        $email_body_user = yck_render_template($template_path, ['mail_data' => $data]);

        // 고객용 메일 전송
        $sent_user = wp_mail($data['email'], $subject_customer, $email_body_user, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <noreply@yconnectkorea.com>',
        ]);

        // 관리자 경고 메일
        $admin_template = plugin_dir_path(__DIR__) . 'templates/error/error_alert.php';

        $email_body_admin = yck_render_template($admin_template, ['mail_data' => $data]);

        $sent_admin = wp_mail('kyungrimha@gmail.com', '[YCK 알림] eSIM 주문 API 실패(-9)', $email_body_admin, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
        ]);
    }

    // [3] API 에러 코드 -1, -2, -3, -4
    elseif (in_array($api_response['result'], [-1, -2, -3, -4])) {
        $admin_template = plugin_dir_path(__DIR__) . 'templates/error/error_alert.php';

        //관리자 템플릿 경로 주석 처리(문제가 있을 경우 다시 주석 해제)
        //error_log('[YCK] 관리자 템플릿 경로: ' . $admin_template);


        $email_body_admin = yck_render_template($admin_template, [
            'mail_data' => $data,
            'error_code' => $api_response['result'],
            'error_reason' => $api_response['reason'] ?? 'Unknown',
        ]);


        $sent_admin = wp_mail('kyungrimha@gmail.com', "[YCK 경고] eSIM 주문 API 실패 (코드: {$api_response['result']})", $email_body_admin, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
        ]);

        error_log($sent_admin ? '[YCK] ✅ 관리자 메일 전송 성공 (코드: ' . $api_response['result'] . ')' : '[YCK] ❌ 관리자 메일 전송 실패 (코드: ' . $api_response['result'] . ')');
    }

    // [4] 그 외 실패
    else {
        error_log('[YCK] eSIM API 실패: ' . json_encode($api_response));
    }
}
