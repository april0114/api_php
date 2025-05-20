<?php
date_default_timezone_set('Asia/Seoul');

function yck_collect_order_data($order, $type = 'esim') {
    $order_id = $order->get_id();
    $mmddyy = date('mdy');
    $custom_order_id = 'YCK' . $mmddyy . $order_id;
    $formatted_payment_date = date('YmdHis');
    

    $data = [
        'order_id'     => $order_id,
        'email'        => $order->get_billing_email(),
        'phone'        => $order->get_billing_phone(),
        'payment_date' => $formatted_payment_date,
    ];
    $email = $data['email'];

    foreach ($order->get_meta_data() as $meta) {
        $data[$meta->key] = $meta->value;
    }

    foreach ($order->get_items() as $item) {
        foreach ($item->get_meta_data() as $meta) {
            $data['item_' . $meta->key] = $meta->value;
        }
    }

    error_log('[YCK] 주문 전체 메타: ' . json_encode($data));

    // 🔽 초기 변수 설정
    $usage_days = [];
    $first_name_raw = '';
    $last_name_raw  = '';
    $mobile         = '';
    $device_model   = '';
    $arrival_date   = '';
    $pickup_location= '';

    // 🔽 item__ywapo_meta_data 파싱
    if (!empty($data['item__ywapo_meta_data']) && is_array($data['item__ywapo_meta_data'])) {
        foreach ($data['item__ywapo_meta_data'] as $entry) {
            foreach ($entry as $field) {
                $addon_id = $field['addon_id'] ?? '';
                $value = $field['addon_value'] ?? '';

                if ($type === 'esim') {
                    switch ($addon_id) {
                        case '24': // usage_days
                            if (preg_match('/\d+/', $value, $m)) $usage_days[] = (int)$m[0];
                            break;
                        case '25':
                            if (str_contains($value, 'First Name:')) {
                                $first_name_raw = $value;
                            } elseif (str_contains($value, 'Last Name:')) {
                                $last_name_raw = $value;
                            }
                            break;
                        case '29': $mobile = $value; break;
                        case '31': $device_model = $value; break;
                        case '32': $arrival_date = $value; break;
                        case '33': $pickup_location = $value; break;
                    }
                }

                if ($type === 'usim') {
                    switch ($addon_id) {
                        case '1': // usage_days
                            if (preg_match('/\d+/', $value, $m)) $usage_days[] = (int)$m[0];
                            break;
                        case '2':
                            if (str_contains($value, 'First Name:')) $first_name_raw = $value;
                            if (str_contains($value, 'Last Name:'))  $last_name_raw = $value;
                            break;
                        case '6': $email = $value; break;
                        case '7': $mobile = $value; break;
                        case '9': $device_model = $value; break;
                        case '10': $arrival_date = $value; break;
                        case '11': $pickup_location = $value; break;
                    }
                }
            }
        }
    }

    // 🔽 이름 클렌징
    $first_name_clean = preg_replace('/[^a-zA-Z가-힣]/u', '', str_replace('First Name: ', '', (string)$first_name_raw));
    $last_name_clean  = preg_replace('/[^a-zA-Z가-힣]/u', '', str_replace('Last Name: ', '', (string)$last_name_raw));

    return [
        'order_id'        => $custom_order_id,
        'first_name'      => $first_name_clean,
        'last_name'       => $last_name_clean,
        'email'           => $email,
        'mobile_number'   => $mobile,
        'device_model'    => $device_model,
        'arrival_date'    => $arrival_date,
        'pickup_location' => $pickup_location,
        'usage_days'      => $usage_days,
        'payment_date'    => $formatted_payment_date,
    ];
}

function yck_render_template($template_file, $variables = []) {
    if (!file_exists($template_file)) {
        error_log('[YCK] 템플릿 파일 없음: ' . $template_file);
        return '';
    }

    extract($variables);
    ob_start();
    include $template_file;
    return ob_get_clean();
}