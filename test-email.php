<?php
// 워드프레스 환경 로드
require_once('../../../wp-load.php');
require_once plugin_dir_path(__FILE__) . '/includes/utils.php';
require_once plugin_dir_path(__FILE__) . 'includes/api_esim.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

// 더미 주문 데이터 (테스트용)
$data = [
    'order_id'        => 'YCK250605011999',
    'first_name'      => 'TEST',
    'last_name'       => 'TEST',
    'email'           => 'sue5520607@naver.com',
    'usage_days'      => 5,
    'payment_date'    => date('YmdHis'),

    // 🔽 이메일 템플릿에서 사용하는 값들 추가
    'mobile_number'   => '+11012345678',
    'device_model'    => 'iPhone 14 Pro',
    'arrival_date'    => '2025-07-01',
    'pickup_location' => 'Incheon International Airport Terminal 1 (1st floor)',
];

// 템플릿 경로 설정
$lang = 'en';
$template_file = "templates/email_template_usim_{$lang}.php";
$template_path = plugin_dir_path(__FILE__) . $template_file;

// HTML 템플릿 렌더링
$email_body = yck_render_template($template_path, ['mail_data' => $data]);

// 이메일 전송
$sent = wp_mail($data['email'], '[Y CONNECT KOREA] This is the installation and activation guide email for the SKT eSIM you ordered', $email_body, [
    'Content-Type: text/html; charset=UTF-8',
    'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
]);

// 결과 출력
echo $sent ? '✅ 이메일 전송 성공! 메일함을 확인하세요.' : '❌ 이메일 전송 실패. 서버 로그를 확인하세요.';
