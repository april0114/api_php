<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

function sendPickupVoucherEmail($to_email, $order_info) {
    $barcode_base64 = generateBarcodeBase64($order_info['order_id']);
    $order_info['barcode_base64'] = $barcode_base64;

    $body = includeTemplate('pickup_voucher_template.php', $order_info);

    return sendEmail($to_email, '[Y CONNECT KOREA] Your Pickup Voucher', $body);
}

function sendEmail($to_email, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = getenv('SMTP_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USER');
        $mail->Password = getenv('SMTP_PASS');
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom(getenv('MAIL_FROM_EMAIL'), getenv('MAIL_FROM_NAME'));
        $mail->addAddress($to_email);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->CharSet = 'UTF-8';

        $mail->send();
        return true;
    } catch (Exception $e) {
        // 로그 + Postman 응답에 표시
        error_log('메일 전송 실패: ' . $mail->ErrorInfo);

        // Postman 응답에 바로 오류 반환
        http_response_code(500);
        echo json_encode([
            "result" => -10,
            "message" => "메일 전송 실패",
            "error" => $mail->ErrorInfo
        ]);
        exit;
    }
}


function includeTemplate($template_name, $variables = []) {
    extract($variables);
    ob_start();
    include __DIR__ . '/email_templates/' . $template_name;
    return ob_get_clean();
}
?>