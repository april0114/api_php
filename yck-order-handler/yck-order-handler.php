<?php
/*
Plugin Name: YCK Order Handler
Description: WooCommerce 주문 완료 후 eSIM / USIM 분리 처리
Version: 1.0
Author: April,Ha
*/

// 주문 완료 트리거
add_action('woocommerce_thankyou', 'yck_handle_order_by_slug', 10, 1);

// 파일 로딩
require_once plugin_dir_path(__FILE__) . 'includes/esim_handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/usim_handler.php';

function yck_handle_order_by_slug($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) return;

    foreach ($order->get_items() as $item) {
        $product = $item->get_product();

        // ✅ 상품의 슬러그 가져오기
        $slug = $product->get_slug(); // 예: esim-data-only, usim-physical
        error_log('[YCK] 상품 슬러그: ' . $slug);

        // 👉 eSIM 슬러그 기준 분기
        if (in_array($slug, ['esim-data-only', 'esim-global'])) {
            yck_handle_esim_order($order);
            return;
        }

        // 👉 USIM 슬러그 기준 분기
        if (in_array($slug, ['usim-physical', 'usim-delivery'])) {
            yck_handle_usim_order($order);
            return;
        }
    }

    error_log('[YCK] 슬러그 분류 실패: order_id = ' . $order_id);
}
