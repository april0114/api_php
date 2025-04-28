<?php
use Picqer\Barcode\BarcodeGeneratorPNG;

require_once __DIR__ . '/vendor/autoload.php';

// email 템플릿에 필요한 변수들 준비
$order_id = 'YCK250201AA0002';
$generator = new BarcodeGeneratorPNG();
$barcode = $generator->getBarcode($order_id, $generator::TYPE_CODE_128);
$barcode_base64 = base64_encode($barcode);
$last_name = 'KIM';
$first_name = 'DARA';
$mobile_number = '+1 2011231234';
$mobile_model = 'iPhone 16';
$arrival_date = '2025-03-01';
$pickup_location = 'Incheon International Airport (Terminal 1)';
$usage_days = '30';

// 템플릿 파일 불러오기
include './pickup_voucher_template.php';
?>
