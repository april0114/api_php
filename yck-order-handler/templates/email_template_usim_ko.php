<!-- templates/email_template_usim_ko.php -->
<?php
require_once WP_PLUGIN_DIR . '/yck-order-handler/includes/barcode128.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <!-- CSS디자인-->
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      color: #333;
      line-height: 1.6;
    }

    h2 {
      color: #000080;
    }

    .highlight {
      color: red;
      font-weight: bold;
    }

    .box-link {
      background-color: #e2efd9;
      border: 1px solid #999;
      padding: 10px;
      margin: 10px 0;
    }

    .section-title {
      font-weight: bold;
      margin-top: 20px;
    }

    table {
      border-collapse: collapse;
      margin: 10px 0;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }

    .green-box {
      background-color: #e2efd9;
      border: 1px solid #999;
      padding: 8px;
    }

    .red-text {
      color: red;
      font-weight: bold;
    }

    .inline-block-fix>* {
      display: inline;
    }
    
      body, table, td, div, p, a {
    font-family: Arial, sans-serif;
    line-height: 1.5;
    font-size: 14px;
    color: #333;
    margin: 0;
    padding: 0;
  }
  p {
    margin: 0;
    padding: 0;
  }
  </style>
</head>

<!-- 로고 이미지-->

<body>
  <a href="https://yconnectkorea.com" target="_blank">
    <img src="https://yconnectkorea.com/wp-content/uploads/2025/04/YCK_logo_01.png" alt="Y CONNECT KOREA Logo"
      style="max-width: 200px; display: block; margin: 20px 0;">
  </a>

  <div style="font-weight: bold; font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
    Y CONNECT KOREA SKT USIM (Airport Pickup)을 주문해 주셔서 진심으로 감사드립니다.
  </div>

  <!-- ■ SKT uSIM 바코드 예약번호 -->
   <div class="section-title">■ SKT USIM (Airport Pickup) 픽업을 위한 바코드</div>
  <table style="border-collapse: collapse; width: 100%; margin-bottom: 20px;">
    <tr>
      <td style="border: 1px solid #000; padding: 10px; text-align: center; width: 30%;">
        Barcode
      </td>
      <td style="border: 1px solid #000; padding: 10px; text-align: center;">
        <?= generateBarcode128($mail_data['order_id']) ?>
      </td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 10px; text-align: center;" colspan="2">
        Reservation Number (Order Number): <strong><?= htmlspecialchars($mail_data['order_id']) ?></strong>
      </td>
    </tr>
  </table>

    <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
      <strong>한국 도착해서 공항 SKT 로밍센터를 방문해 주세요.</strong>
    </div>

    <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
      <strong>(1)</strong> 본 바우처의 바코드(주문번호)와 고객님 여권을 제시해 주시고,
    </div>

    <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
      <strong>(2)</strong> 음성/문자 발신이 필요하신 분께서는 음성/문자 발신용 금액을 충전하시면 됩니다.
    </div>

    <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
      여권정보 본인 확인과 충전이 완료되면 SKT SIM 카드를 수령하실 수 있습니다.
    </div>

    <div style="font-size: 14px; line-height: 1.6; color: red; font-weight: bold; margin-bottom: 1px;">
      ※ 발신 요금 충전은 한국에서 사용 가능한 본인 신용카드로 결제하셔야 하며,<br>
      공항 SKT 로밍센터에서 대기자가 많을 경우, 온라인으로 충전할 것을 요청할 수 있습니다.
    </div>

  <hr style="margin: 30px 0;">




  <!--■ SKT USIM (Airport Pickup) 예약 정보-->
  <div class="section-title">■ SKT USIM (Airport Pickup) 예약 정보</div>
  <table style="border-collapse: collapse; width: 100%; table-layout: fixed;">
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Last Name / First
        Name</td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
        <?= htmlspecialchars($mail_data['last_name']) ?> <?= htmlspecialchars($mail_data['first_name']) ?></td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Mobile Number</td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">+1
        <?= htmlspecialchars($mail_data['mobile_number']) ?></td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Mobile Model Name
      </td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
        <?= htmlspecialchars($mail_data['device_model']) ?></td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Arrival Date in
        Korea </td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
        <?= htmlspecialchars($mail_data['arrival_date']) ?></td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; color: red;">Pickup
        / Passport Verification / Charge</td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; color: red;">
        <?= htmlspecialchars($mail_data['pickup_location']) ?></td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Usage Days</td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
        <?= htmlspecialchars(implode(', ', (array) $mail_data['usage_days'])) ?> days</td>
    </tr>
  </table>


  <!--■ 온라인 음성/문자 발신용 금액 재충전-->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ 음성/문자 발신용 금액 충전
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  ※ 음성/문자 발신은 금액 충전 시 이용이 가능하며 음성/문자 수신은 무료로 이용이 가능합니다.
</div>

<div style="text-align: right; font-size: 12px; margin-bottom: 1px;">
  *부가세 포함입니다
</div>

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse; text-align: center; font-size: 14px; line-height: 1.6; margin-bottom: 24px;">
  <tr style="background-color: #fff0b3;">
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">충전 금액</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩5,500</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩11,000</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩22,000</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩33,000</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩55,000</td>
  </tr>
  <tr style="background-color: #e2efd9;">
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">예상 통화분수</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">약 20분 통화</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">약 40분 통화</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">약 80분 통화</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">약 120분 통화</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">약 200분 통화</td>
  </tr>
</table>

<!--■ 공항 SKT 로밍센터 안내-->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ 공항 SKT 로밍센터 안내
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
  SKT 로밍센터를 방문하기 전에 장소와 근무시간을 확인하세요.
</div>

<div style="text-align: left; font-weight: bold; font-size: 14px; background-color: #e2efd9; border: 1px solid #999; padding: 10px; margin-bottom: 16px;">
  <a href="https://yconnectkorea.com/contact/" target="_blank" style="color: black; text-decoration: underline;">
    SKT 로밍센터 위치
  </a>
</div>

<!--■ 온라인 음성/문자 발신용 금액 충전 방법 -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ 온라인 음성/문자 발신용 금액 재충전
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  <strong>음성/문자 충전 페이지 접속:</strong>
  <a href="https://www.skroaming.com/reservation/charging" target="_blank">
    https://www.skroaming.com/reservation/charging
  </a>
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  ① 로그인 정보 입력:<br>
  렌털 계약 번호 / USIM 010 전화번호 (이 정보는 SKT 로밍센터에서 심카드 픽업 시 제공됩니다)
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  ② 충전 금액 결정:<br>
  5,500원 / 11,000원 / 22,000원 / 33,000원 / 55,000원 (부가세 포함입니다)
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  ③ 결제 카드 입력:<br>
  충전 금액 결제 (한국에서 사용 가능한 신용카드로 결제하셔야 합니다)
</div>

<hr style="margin: 26px 0;">

<!--맺음말-->
<div class="section-title" style="font-weight: bold; font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
  주문 내역에 착오가 있거나, 추가 궁금한 것이 있으시면,<br>
  고객님 주문 번호와 문의 사항을 이메일로 보내 주시면 바로 답변 드리겠습니다.<br>
  다시 한번 Y CONNECT KOREA SKT USIM (Airport Pickup)을 주문해 주심에 진심으로 감사드립니다.
</div>

<div class="inline-block-fix" style="margin-top: 16px;">
  <div class="section-title" style="font-weight: bold; font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    Y CONNECT KOREA<br>
    고객지원센터
  </div>
  <div style="font-size: 14px; margin-bottom: 16px;">
    <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a>
  </div>
</div>
</body>
</html>