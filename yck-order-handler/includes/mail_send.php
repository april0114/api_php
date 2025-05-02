<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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


function yck_send_email($data) {
    ob_start();
    include __DIR__ . '/../templates/email_template.php';
    $message = ob_get_clean();

    sendEmail(
        $mail_data['email'],                        // 고객 이메일 주소
        "[YCK] 주문 완료 - {$mail_data['order_id']}", // 메일 제목
        $message                                    // 메일 내용 (템플릿에서 만든 HTML)
    );


}
