<?php
/*
Plugin Name: YCK Order Handler
Description: WooCommerce 주문 완료 후 eSIM / USIM 분리 처리
Version: 1.0
Author: April Ha, Kevin Han(Advice Digital Marketing Inc.)
*/

// 주문 완료 트리거
//add_action('woocommerce_thankyou', 'yck_handle_order_by_slug', 10, 1);
add_action('woocommerce_order_status_completed', 'yck_handle_order_by_slug', 10, 1);


// 파일 로딩
require_once plugin_dir_path(__FILE__) . 'includes/esim_handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/usim_handler.php';

function yck_handle_order_by_slug($order_id)
{
    $timestamp = date('[Y-m-d H:i:s]');
    $order = wc_get_order($order_id);
    if (!$order)
        return;

    foreach ($order->get_items() as $item) {
        $product = $item->get_product();
        $slug = $product->get_slug(); 
        
        //짧은 로그를 위해 주석처리 (오류가 발생했을시 주석해제후 사용)
        //error_log('[YCK] 상품 슬러그: ' . $slug);

        // 언어 구분: 'en_'이면 영어
        $lang = str_starts_with($slug, 'en_') ? 'en' : 'ko';

        // 실제 slug만 추출
        $pure_slug = $lang === 'en' ? substr($slug, 3) : $slug;

        // eSIM 처리
        if (in_array($pure_slug, ['esim-data-only', 'esim-data-call-sms', 'esim-global'])) {
            yck_handle_esim_order($order, $lang);
            return;
        }

        // USIM 처리
        if (in_array($pure_slug, ['usim-airport-pickup', 'usim-delivery'])) {
            yck_handle_usim_order($order, $lang);
            return;
        }
    }

    error_log($timestamp . '[YCK] 슬러그 분류 실패: order_id = ' . $order_id);
}
