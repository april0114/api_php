<?php
date_default_timezone_set('Asia/Seoul');

function yck_collect_order_data($order, $type = 'esim') {
    $order_id = $order->get_id();
    $mmddyy = date('mdy');
    $formatted_order_number = $order->get_meta('_order_number_formatted', true);
    $formatted_payment_date = date('YmdHis');

    $data = [
        'order_id'     => $formatted_order_number,
        'payment_date' => $formatted_payment_date,
    ];

    // 메타데이터 수집
    foreach ($order->get_meta_data() as $meta) {
        $data[$meta->key] = $meta->value;
    }

    // 아이템 메타데이터 수집
    foreach ($order->get_items() as $item) {
        foreach ($item->get_meta_data() as $meta) {
            $data['item_' . $meta->key] = $meta->value;
        }
    }

    // 디버깅 로그로 전체 데이터 출력(로그의 부하를 줄이기 위해 주석 처리함 - 추후 문제 생겼을 시 주석 제거 후 확인)
    //error_log($timestamp . '[YCK] 주문 전체 메타: ' . json_encode($data, JSON_UNESCAPED_UNICODE));

    // 주요 사용자 입력 정보 추출
    $first_name      = $data['item_Firstname'] ?? '';
    $last_name       = $data['item_Lastname'] ?? '';
    $passport_number = $data['item_passport_number'] ?? '';
    $email           = $data['item_email'] ?? '';
    $mobile          = $data['item_phone'] ?? '';
    $device_model    = $data['item_mobilemodelname'] ?? '';
    $arrival_date    = $data['item_arrival_date'] ?? '';
    $pickup_location = $data['item_arrival_terminal'] ?? '';
    $usage_days      = [];

    // YITH 필드: item__ywapo_meta_data에서 59번만 추출
    if (!empty($data['item__ywapo_meta_data']) && is_array($data['item__ywapo_meta_data'])) {
        foreach ($data['item__ywapo_meta_data'] as $entry) {
            foreach ($entry as $key => $field) {
                if (isset($field['addon_id']) && (string)$field['addon_id'] === '59') {
                    if (!empty($field['addon_value']) && preg_match('/\d+/', $field['addon_value'], $matches)) {
                        $usage_days[] = (int)$matches[0];
                    }
                }
            }
        }
    }

    //최종 가공된 배열 반환
    return [
        'order_id'        => $formatted_order_number,
        'first_name'      => $first_name,
        'last_name'       => $last_name,
        'passport_number' => $passport_number,
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
    $timestamp = date('[Y-m-d H:i:s]');
    if (!file_exists($template_file)) {
        error_log($timestamp . '[YCK] 템플릿 파일 없음: ' . $template_file);
        return '';
    }

    extract($variables);
    ob_start();
    include $template_file;
    return ob_get_clean();
}