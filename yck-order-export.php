<?php
/*
Plugin Name: YCK Order Export
Description: Export WooCommerce orders (with all custom fields) to CSV by date range.
Version: 1.3
Author: April Ha
*/

if (!defined('ABSPATH')) exit;

// 관리자 메뉴 추가
add_action('admin_menu', function () {
    add_submenu_page(
        'woocommerce',
        'Order Export',
        'Order Export',
        'manage_woocommerce',
        'wc-order-export',
        'wc_order_export_page'
    );
});

function wc_order_export_page()
{
    ?>
    <div class="wrap">
        <h1>WooCommerce Order Export</h1>
        <form method="post">
            <label>Start Date: <input type="date" name="start_date" required></label>
            <label>End Date: <input type="date" name="end_date" required></label>
            <input type="submit" name="export_csv" class="button button-primary" value="Export CSV">
        </form>
    </div>
    <?php

    if (isset($_POST['export_csv'])) {
        wc_generate_order_csv($_POST['start_date'], $_POST['end_date']);
    }
}

function wc_generate_order_csv($start_date, $end_date)
{
    $args = [
        'status'       => ['completed', 'processing', 'on-hold'],
        'date_created' => $start_date . '...' . $end_date,
        'limit'        => -1,
    ];

    $orders = wc_get_orders($args);

    // CSV 헤더
    header('Content-Type: text/csv; charset=CP949');
    header('Content-Disposition: attachment;filename=orders-' . $start_date . '_to_' . $end_date . '.csv');

    if (ob_get_length()) ob_clean();
    flush();
    $output = fopen('php://output', 'w');

    // CSV 컬럼 정의
    $headers = [
        'Order ID',
        'Order Date',
        'Order Status',
        'Customer Name',
        'Customer Email',
        'Customer Phone',
        'Billing Address',
        'Shipping Address',
        'Payment Method',
        'Total',
        'Product Name',
        'Product Qty',
        // 주문 메타
        'Stripe Fee',
        'Stripe Net',
        'Attribution Source',
        'Attribution Referrer',
        // 상품 커스텀 필드
        'Firstname',
        'Lastname',
        'Nationality',
        'Passport Number',
        'Mobile Carrier',
        'Mobile Model',
        'Arrival Date',
        'Arrival Terminal',
        'Data Usage Period',
        'Customer Email (Item)',
        'Customer Phone (Item)'
    ];

    fputcsv($output, $headers);

    // 주문 루프
    if (!empty($orders)) {
        foreach ($orders as $order) {
            foreach ($order->get_items() as $item) {

                // 주문 번호 (Formatted → 기본 ID fallback)
                $order_id = $order->get_meta('_order_number_formatted', true);
                if (empty($order_id)) {
                    $order_id = $order->get_id();
                }

                // 주문 메타 가져오기
                $stripe_fee   = $order->get_meta('_stripe_fee');
                $stripe_net   = $order->get_meta('_stripe_net');
                $attr_source  = $order->get_meta('_wc_order_attribution_utm_source');
                $attr_ref     = $order->get_meta('_wc_order_attribution_referrer');

                // 아이템 메타 가져오기
                $item_meta = [];
                foreach ($item->get_meta_data() as $meta) {
                    $item_meta[$meta->key] = is_array($meta->value) 
                        ? json_encode($meta->value, JSON_UNESCAPED_UNICODE) 
                        : $meta->value;
                }

                // Data Usage Period 처리 (배열일 경우 문자열로 변환)
                $usage_days = '';
                if (!empty($item_meta['usage_days'])) {
                    $usage_days = is_array($item_meta['usage_days']) 
                        ? implode(', ', $item_meta['usage_days']) 
                        : $item_meta['usage_days'];
                } else {
                    $usage_days = $item_meta['ywapo-addon-76-9'] ?? $item_meta['item_ywapo-addon-76-9'] ?? '';
                }

                // CSV 한 줄 쓰기
                $row = [
                    $order_id,
                    $order->get_date_created() ? $order->get_date_created()->date('Y-m-d H:i:s') : '',
                    $order->get_status(),
                    $order->get_formatted_billing_full_name(),
                    $order->get_billing_email(),
                    $order->get_billing_phone(),
                    strip_tags($order->get_formatted_billing_address()),
                    strip_tags($order->get_formatted_shipping_address()),
                    $order->get_payment_method_title(),
                    $order->get_total(),
                    $item->get_name(),
                    $item->get_quantity(),
                    // 주문 메타
                    $stripe_fee,
                    $stripe_net,
                    $attr_source,
                    $attr_ref,
                    // 아이템 메타
                    $item_meta['item_Firstname'] ?? $item_meta['Firstname'] ?? '',
                    $item_meta['item_Lastname'] ?? $item_meta['Lastname'] ?? '',
                    $item_meta['item_nationality'] ?? $item_meta['nationality'] ?? '',
                    $item_meta['item_passport_number'] ?? $item_meta['passport_number'] ?? '',
                    $item_meta['item_mobilecarrier'] ?? $item_meta['mobilecarrier'] ?? '',
                    $item_meta['item_mobilemodelname'] ?? $item_meta['mobilemodelname'] ?? '',
                    $item_meta['item_arrival_date'] ?? $item_meta['arrival_date'] ?? '',
                    $item_meta['item_arrival_terminal'] ?? $item_meta['arrival_terminal'] ?? '',
                    $usage_days,
                    $item_meta['item_email'] ?? '',
                    $item_meta['item_phone'] ?? ''
                ];

                // CP949 변환
                $row = array_map(function ($v) {
                    return is_string($v) ? mb_convert_encoding($v, 'CP949', 'UTF-8') : $v;
                }, $row);

                fputcsv($output, $row);
            }
        }
    }

    fclose($output);
    exit;
}
