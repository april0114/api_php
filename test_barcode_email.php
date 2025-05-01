<?php
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Picqer\Barcode\BarcodeGeneratorPNG;

// 1. 바코드 생성
$order_id = 'TEST123456';
$generator = new BarcodeGeneratorPNG();
$barcode = $generator->getBarcode($order_id, $generator::TYPE_CODE_128);
$barcode_base64 = base64_encode($barcode);

// 2. HTML 메일 본문 생성
$mail_body = '
<html><body>
    <h3>Test Barcode</h3>
    <p>Order ID: ' . $order_id . '</p>
    <img src="data:image/png;base64,' . $barcode_base64 . '" alt="Barcode" style="width:250px;" />
</body></html>';

// 3. 메일 전송
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = getenv('SMTP_HOST');
    $mail->SMTPAuth = true;
    $mail->Username = getenv('SMTP_USER');
    $mail->Password = getenv('SMTP_PASS');
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('kyungrimha@gmail.com', 'Test Mail');
        $mail->addAddress('devops@koreatimes.com'); // 🔁 여기 테스트용 이메일로 바꿔줘

    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = '🔍 Barcode Image Test';
    $mail->Body    = $mail_body;

    $mail->send();
    echo "✅ 메일 전송 완료!";
} catch (Exception $e) {
    echo "❌ 메일 전송 실패: {$mail->ErrorInfo}";
}
