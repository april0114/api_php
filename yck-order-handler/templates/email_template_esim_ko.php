<!-- templates/email_template_esim_ko.php -->
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>[Y CONNECT KOREA] SKT eSIM 설치 및 활성화 안내</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6; }
    h2 { color: #000080; }
    .highlight { color: red; font-weight: bold; }
    .box-link {
      background-color: #e2efd9;
      border: 1px solid #999;
      padding: 10px;
      margin: 10px 0;
    }
    .section-title { font-weight: bold; margin-top: 20px; }
    table { border-collapse: collapse; margin: 10px 0; width: 100%; }
    td, th { border: 1px solid #ccc; padding: 8px; text-align: left; }
    .green-box { background-color: #e2efd9; border: 1px solid #999; padding: 8px; }
    .red-text { color: red; font-weight: bold; }
  </style>
</head>
<body>

<a href="https://yconnectkorea.com" target="_blank">
  <img src="https://yconnectkorea.com/wp-content/uploads/2025/04/YCK_logo_01.png" 
       alt="Y CONNECT KOREA Logo" 
       style="max-width: 200px; display: block; margin: 20px 0;">
</a>
<p><strong>Y CONNECT KOREA SKT eSIM 을 주문해 주셔서 진심으로 감사드립니다.<br><br>
본 안내 이메일은 고객님 eSIM 설치와 한국에서 휴대폰 사용에 도움을 드리고자 발송되었습니다.<br>
주문이 완료되면 본 설치 가이드 이메일과 함께 QR 코드 이메일을 별도도 받으셔야 합니다.</strong></p>

<p class="highlight">만약 주문 후 24시간이 지나도 한국 협력업체로부터 QR 코드이메일(영문)을 받지 못하셨다면:</p>

 <p><strong>1.이메일의 스팸 메일함 또는 프로모션 탭을 확인해 주시기 바랍니다.</strong></p>
  <p><strong>2.위의 1번 사항을 확인해도 받지 못한 경우엔,  <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a> 으로 QR코드 미수신/고객님 성함/휴대폰전화번호/주문번호를 함께 적어 보내 주시면 바로 확인 처리해 드립니다.</strong></p>


<?php
$raw_date = $mail_data['arrival_date'] ?? '';
$formatted_date = '';

try {
    $date = DateTime::createFromFormat('d/m/Y', $raw_date);
    if ($date !== false) {
        $formatted_date = $date->format('Y-m-d');
    }
} catch (Exception $e) {
    $formatted_date = $raw_date; // 실패하면 원본 그대로 출력
}
?>

<!-- ■ SKT eSIM 예약번호(주문번호) -->
<div class="section-title">■ SKT eSIM 예약번호(주문번호)</div>
<table style="border-collapse: collapse; width: 100%; table-layout: fixed;">
  <tr>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle; width: 50%;">
      예약번호(주문번호)
    </td>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle; width: 50%;">
      <?= htmlspecialchars($mail_data['order_id']) ?>
    </td>
  </tr>
</table>

<!-- ■ SKT eSIM 예약정보 -->
<div class="section-title">■ SKT eSIM 예약정보</div>
<table style="border-collapse: collapse; width: 100%; table-layout: fixed;">
  <tr>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle;">Last Name / First Name</td>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle;"><?= htmlspecialchars($mail_data['last_name']) ?> <?= htmlspecialchars($mail_data['first_name']) ?></td>
  </tr>
  <tr>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle;">Mobile Number</td>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle;">+1 <?= htmlspecialchars($mail_data['mobile_number']) ?></td>
  </tr>
  <tr>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle;">Mobile Model Name</td>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle;"><?= htmlspecialchars($mail_data['device_model']) ?></td>
  </tr>
  <tr>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle;">Arrival Date in Korea</td>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle;"><?= htmlspecialchars($formatted_date) ?></td>
  </tr>
  <tr>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle; color: red;">Pickup / Passport Verification / Charge</td>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle; color: red;">Incheon International Airport (Terminal 1)</td>
  </tr>
  <tr>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle;">Usage Days</td>
    <td style="border: 1px solid #ccc; padding: 12px; text-align: center; vertical-align: middle;"><?= htmlspecialchars(implode(', ', (array)$mail_data['usage_days'])) ?> days</td>
  </tr>
</table>



<div class="section-title">■ eSIM 설치 및 한국 도착해서 활성화 방법</div>
<p>※본 eSIM QR코드의 스캔 기간은 주문 후 1년이며, 1년 이후에는 스캔하실 수 없습니다.<br>
※eSIM Profile을 삭제할 경우, 신규 eSIM을 주문해야만 사용할 수 있습니다. 
</p>
<div class="box-link" style="text-align: center; font-weight: bold;">
  <a href="https://yconnectkorea.com/esim-install" target="_blank" style="color: black; text-decoration: none;">
    eSIM 설치 및 한국 도착해서 활성화 방법 상세 보기
  </a>
</div>
<div class="section-title">■ 음성/문자 수신과 발신 서비스까지 이용하는 방법</div>
<p class="red-text">(※ Data 만 이용하실 분은 아래 절차가 필요 없습니다)</p>
  <p>미국에서 eSIM을 먼저 설치하시고 한국 도착 후, 공항의 SKT 로밍센터를 방문해 주세요.</p>


<p>1. QR 코드 이메일(주문번호/렌털 계약 번호/ eSIM 010 전화번호) 제출</p>
 <p>2. 본인 여권(여권 정보 진위 여부 확인) 제출</p>
<p>3. 음성/문자 발신용 금액 충전 (한국에서 사용 가능한 본인 신용카드로 결제)</p>


<div class="section-title">■ 음성/문자 발신용 금액 충전</div>
<p>※ 음성/문자 발신은 금액 충전 시 이용이 가능하며 음성/문자 수신은 무료로 이용이 가능합니다.</p>
<div style="text-align: right; font-size: 12px; margin-bottom: 5px;">*부가세 포함</div>

<table style="border-collapse: collapse; width: 100%; text-align: center;">
  <tr style="background-color: #fff0b3;">
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">충전 금액</th>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩5,500</th>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩11,000</th>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩22,000</th>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩33,000</th>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩55,000</th>
  </tr>
  <tr style="background-color: #e6ffee;">
    <td style="border: 1px solid #ccc;border-top: 2px solid #333; padding: 10px;">예상 통화분수</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">약 20분 통화</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">약 40분 통화</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">약 80분 통화</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">약 120분 통화</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">약 200분 통화</td>
  </tr>
</table>


<div class="section-title">■ 공항 SKT 로밍센터 안내</div>
<p>SKT 로밍센터를 방문하기전에 장소와 근무시간을 확인하세요.</p>

<div class="box-link" style="text-align: center; font-weight: bold;">
  <a href="https://yconnectkorea.com/esim-install" target="_blank" style="color: black; text-decoration: none;">
    SKT 로밍센터 상세 보기
  </a>
</div>

<div class="section-title">■ 온라인 여권 정보 진위 여부 확인 (외국 여권 소지자만 가능)</div>
<p>※ Data 만 이용하실 분은 여권 정보 진위 여부 확인이 필요 없습니다.</p>
<p style="color: red;">※ 대한민국 여권 보유자는 여권 정보 진위 여부 확인을 온라인에서 이용할 수 없습니다.</p>
<p>한국 출입국 관리소 통과 이후에, 매일 8시부터 22시까지 확인 가능합니다. </p>
<p>
  <strong>여권 정보 인증 페이지 접속:</strong> 
  <a href="https://www.skroaming.com/passport/" target="_blank">https://www.skroaming.com/passport/</a>
</p>

<p>① 로그인 정보 입력:<br>
렌털 계약 번호 / eSIM 010 전화번호 (이 정보는 QR 코드 이메일에 제공됩니다)</p>

<p>② 여권정보 입력:<br>
성 / 이름 / 여권번호 / 생년월일 / 국적 (여권상 표시와 동일해야 합니다)</p>


<div class="section-title">■ 온라인 음성/문자 발신용 금액 충전 방법 </div>
<p style="color: red;">※ 여권 정보 진위 여부 확인을 마치신 고객님에 한하여 이용할 수 있습니다.</p>

 <p><strong>음성/문자 충전 페이지 접속:</strong>  <a href="https://www.skroaming.com/reservation/charging" target="_blank">https://www.skroaming.com/reservation/charging</a> </p>
<p>로그인 정보 입력:<br>
렌털 계약 번호/ eSIM 010 전화번호 (이 정보는 QR 코드 이메일에 제공됩니다)</p>
<p>② 충전 금액 결정:<br>
5,500원 / 11,000원 / 22,000원 / 33,000원 / 55,000원 (부가세 포함입니다) 
</p>
<p>
    ③ 결제 카드 입력:<br>
충전 금액 결제 (한국에서 사용 가능한 신용카드로 결제하셔야 합니다) 
</p>
<hr>
<div class="section-title">
    주문 내역에 착오가 있거나, 그 외 궁금한 사항이 있으시면, <br>
고객님 주문 정보와 함께 문의 사항을 적으셔서 contact@yconnectkorea.com 으로 <br>
이메일 보내 주시면 바로 답변 드리겠습니다.<br>
다시 한번 Y Connect Korea SKT eSIM을 주문해 주심에 진심으로 감사드립니다.
</div>

<div class="section-title">
Y CONNECT KOREA, INC. <br>
고객지원센터
</div>
<p><a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a></p>

</body>
</html>
