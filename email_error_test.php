<?php
// 워드프레스 환경 로드
require_once('../../../wp-load.php');

// utils, render 함수 포함되어 있어야 함
require_once plugin_dir_path(__FILE__) . 'includes/utils.php';

$data = [
    'order_id'        => 'YCK240605ERRORTEST',
    'first_name'      => 'April',
    'last_name'       => 'Ha',
    'email'           => 'yckforward@gmail.com',
    'usage_days'      => 5,
    'payment_date'    => date('YmdHis'),

    // 아래 항목들은 error_alert 템플릿에서 필요할 수 있음
    'mobile_number'   => '82-10-1234-5678',
    'device_model'    => 'iPhone 14 Pro',
    'arrival_date'    => '2025-07-01',
    'pickup_location' => '인천공항 제1터미널 KT로밍센터',
];

$error_code = -9;
$error_reason = '강제 테스트 에러입니다. 인증 실패 시뮬레이션';

// 템플릿 경로: error_alert.php
$template_path = plugin_dir_path(__FILE__) . 'templates/error/error_alert.php';

// 템플릿 렌더링
$email_body = yck_render_template($template_path, [
    'mail_data' => $data,
    'error_code' => $error_code,
    //'error_reason' => $error_reason,
]);

// 메일 전송
$sent = wp_mail('yckforward@gmail.com', "[YCK 테스트] 주문 API 실패 (코드: {$error_code})", $email_body, [
    'Content-Type: text/html; charset=UTF-8',
    'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
]);

echo $sent ? '✅ 테스트 이메일 전송 성공!' : '❌ 이메일 전송 실패. 서버 로그를 확인하세요.';

error_log('[에러로그 테스트: '. PHP_EOL, 3, __DIR__ . '/includes/error/error_log');
