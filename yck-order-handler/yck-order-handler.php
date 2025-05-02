<?php
/*
Plugin Name: YCK Order Handler
Description: WooCommerce 주문 완료 시 메일 및 프리피아 API 전송
*/

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/includes/mail_send.php';
require_once __DIR__ . '/includes/api_send.php';

use Dotenv\Dotenv;

// env 환경변수 사용가능 하게 하는 역할
add_action('init', function () {
    if (file_exists(__DIR__ . '/.env')) {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }
});

// 주문번호 생성 함수: AA000 ~ ZZ999
function yck_generate_order_code($index) {
    $alpha_index = floor($index / 1000);
    $number_part = str_pad($index % 1000, 3, '0', STR_PAD_LEFT);

    $first = floor($alpha_index / 26);
    $second = $alpha_index % 26;

    if ($first >= 26) {
        throw new Exception("주문번호 초과: ZZ999를 넘어감");
    }

    $prefix = chr(65 + $first) . chr(65 + $second);
    return $prefix . $number_part;
}

//우커머스 메인 훅
add_action('woocommerce_thankyou', 'yck_handle_order', 10, 1);

function yck_handle_order($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;

    // 주문번호 생성 (YCK + 날짜 + AA000 ~ ZZ999 형식)
    $order_suffix = yck_generate_order_code($order_id); // AA000 ~ ZZ999
    $order_code = 'YCK' . date('ymd') . $order_suffix;

    //  WooCommerce 원본 전체 정보 (이메일용)
    $data = [
        'order_id'      => $order_code,
        'first_name'    => $order->get_billing_first_name(),
        'last_name'     => $order->get_billing_last_name(),
        'email'         => $order->get_billing_email(),
        'phone'         => $order->get_billing_phone(),
        'esim_day'      => $order->get_meta('esim_day'),
        'device_model'  => $order->get_meta('device_model'),
        'arrival_date'  => $order->get_meta('arrival_date'),
        'payment_date'  => date('YmdHis'),
        'order_items'   => $order->get_items()
    ];

    // 1️⃣ 메일 전송 - 전체 데이터 그대로
    yck_send_email($data);

    // 2️⃣ API 전송 - 이름만 가공하고 order_id는 그대로
    $api_payload = [
        'order_id'        => $order_code,
        'buy_user_name'   => $data['first_name'] . ' ' . $data['last_name'],
        'buy_user_email'  => $data['email'],
        'esim_day'        => [(int) $data['esim_day']],
        'payment_date'    => $data['payment_date']
    ];

    yck_send_api($api_payload);
}
