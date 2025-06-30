<?php
require_once plugin_dir_path(__FILE__) . '/utils.php';
require_once plugin_dir_path(__FILE__) . '/api_usim.php';

function yck_handle_usim_order($order)
{
    $timestamp = date('[Y-m-d H:i:s]');
    // [1] 주문 내 첫 번째 상품의 slug를 기준으로 언어 결정 (en_으로 시작하면 영어, 아니면 한국어)
    // 상품의 slug 기반 언어 결정
    $slug = '';
    foreach ($order->get_items() as $item) {
        $slug = $item->get_product()->get_slug();
        break;
    }
    $lang = str_starts_with($slug, 'en_') ? 'en' : 'ko';


    // [2] 주문 데이터 수집 (utils.php에 정의된 함수로)
    $data = yck_collect_order_data($order, 'usim');

    // [3] 최종 데이터 로깅 (디버깅용)
    error_log($timestamp . '[YCK] JSON 최종 전송값: ' . json_encode($data, JSON_UNESCAPED_UNICODE) . PHP_EOL, 3, __DIR__ . '/error/error.log');

    // [4] USIM API 호출 (api_usim.php의 함수 사용)
    $api_response = yck_send_usim_to_api($data, 'usim'); // usim API 호출

    // [5] 이메일 템플릿 경로 및 제목 설정 (언어에 따라 다르게 설정)
    $template_file = "templates/email_template_usim_{$lang}.php";
    $template_path = plugin_dir_path(__DIR__) . $template_file;
    $subject_customer = $lang === 'en' ? '[Y CONNECT KOREA] This is the voucher email for the SKT USIM (Airport Pickup) you ordered' : '[Y CONNECT KOREA] This is the voucher email for the SKT USIM (Airport Pickup) you ordered';

    //API가 정상적으로 처리된 경우 (result === 1)
    // 실제 배포 시에는 === 1 조건으로 정확히 비교
    if ($api_response['result'] === 1) {
        $email_body = yck_render_template($template_path, ['mail_data' => $data]);
        $sent = wp_mail($data['email'], $subject_customer, $email_body, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <noreply@yconnectkorea.com>',
        ]);

        // 전송 결과 로깅
        error_log($timestamp . '[YCK] ✅ USIM 이메일 전송 성공' . PHP_EOL, 3, __DIR__ . '/error/error.log');
  }

    //API 실패이지만 결제는 완료된 경우 (result === -9)
    elseif ($api_response['result'] === -9) {
        $email_body_user = yck_render_template($template_path, ['mail_data' => $data]);
        wp_mail($data['email'], $subject_customer, $email_body_user, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT KOREA <noreply@yconnectkorea.com>',
        ]);
        // 관리자에게 수동 등록 요청 메일 발송
        $admin_template = plugin_dir_path(__DIR__) . 'templates/error/error_alert.php';
        $email_body_admin = yck_render_template($admin_template, ['mail_data' => $data]);
        wp_mail('yckforward@gmail.com', '[YCK 알림] USIM 주문 API 실패(-9) - 수동 등록 필요', $email_body_admin, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
        ]);
    }

    // 명시적 에러코드 대응
    elseif (in_array($api_response['result'], [-1, -2, -3, -5])) {
        $admin_template = plugin_dir_path(__DIR__) . 'templates/error/error_alert.php';
        $email_body_admin = yck_render_template($admin_template, [
            'mail_data' => $data,
            'error_code' => $api_response['result'],
            'error_reason' => $api_response['reason'] ?? 'Unknown',
        ]);

        wp_mail('yckforward@gmail.com', "[YCK 경고] USIM 주문 API 실패 (코드: {$api_response['result']})", $email_body_admin, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
        ]);

        error_log($timestamp . '[YCK] 관리자에게 에러코드 ' . $api_response['result'] . ' 메일 전송됨' . PHP_EOL, 3, __DIR__ . '/error/error.log');
    }

    // 그 외 예상치 못한 실패 응답 처리
    else {
        $admin_template = plugin_dir_path(__DIR__) . 'templates/error/error_alert.php';

        $email_body_admin = yck_render_template($admin_template, [
            'mail_data' => $data,
            'error_code' => $api_response['result'] ?? 'Unknown',
            'error_reason' => $api_response['reason'] ?? 'Unknown',
            'raw_response' => json_encode($api_response, JSON_UNESCAPED_UNICODE),
        ]);

        wp_mail('yckforward@gmail.com', '[YCK 경고] USIM 주문 API 실패 (예상치 못한 응답)', $email_body_admin, [
            'Content-Type: text/html; charset=UTF-8',
            'From: Y CONNECT 시스템 <noreply@yconnectkorea.com>',
        ]);

        error_log($timestamp . '[YCK] 기타 USIM API 실패 메일 전송됨: ' . json_encode($api_response, JSON_UNESCAPED_UNICODE) . PHP_EOL, 3, __DIR__ . '/error/error.log');
    }
}
