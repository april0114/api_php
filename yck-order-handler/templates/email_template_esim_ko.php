<!-- templates/email_template_esim_ko.php -->
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">


  <!--CSS-->
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
    Y CONNECT KOREA SKT eSIM 을 주문해 주셔서 진심으로 감사드립니다.
  </div>
  <div style="font-weight: bold; font-size: 14px; line-height: 1.6;">
    본 안내 이메일은 고객님 eSIM 설치와 한국에서 휴대폰 사용에 도움을 드리고자 발송되었습니다.
  </div>
  <div style="font-weight: bold; font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
    주문이 완료되면 본 설치 가이드 이메일과 함께 QR 코드 이메일을 별도로 받으셔야 합니다.
  </div>

  <!-- ■ SKT eSIM 예약번호(주문번호) -->
  <div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 20px; margin-bottom: 8px;">
    ■ SKT eSIM 예약번호(주문번호)
  </div>
  <table style="border-collapse: collapse; width: 100%; table-layout: fixed;">
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; width: 50%;">
        예약번호(주문번호)
      </td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; width: 50%;">
        <?= htmlspecialchars($mail_data['order_id']) ?>
      </td>
    </tr>
  </table>



  <!-- ■ SKT eSIM 예약정보 -->
  <div class="section-title">■ SKT eSIM 예약정보</div>
  <table style="border-collapse: collapse; width: 100%; table-layout: fixed;">
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Last Name / First
        Name</td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
        <?= htmlspecialchars($mail_data['last_name']) ?> <?= htmlspecialchars($mail_data['first_name']) ?>
      </td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Mobile Number</td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">+1
        <?= htmlspecialchars($mail_data['mobile_number']) ?>
      </td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Mobile Model Name
      </td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
        <?= htmlspecialchars($mail_data['device_model']) ?>
      </td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Arrival Date in
        Korea</td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
        <?= htmlspecialchars($mail_data['arrival_date']) ?>
      </td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; color: red;">Pickup
        / Passport Verification / Charge</td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; color: red;">
        <?= htmlspecialchars($mail_data['pickup_location']) ?>
      </td>
    </tr>
    <tr>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Usage Days</td>
      <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
        <?= htmlspecialchars(implode(', ', (array) $mail_data['usage_days'])) ?> days
      </td>
    </tr>
  </table>


<!-- ■ SKT eSIM 설치, 활성화 방법 -->
<div style="font-weight: bold; font-size: 14px; margin-top: 20px; margin-bottom: 1px;">
  ■ eSIM 설치 및 한국 도착해서 활성화 방법
</div>

<div style="font-size: 14px; line-height: 1.6; color: #333; font-family: Arial, sans-serif;">
  <div>
    ※본 eSIM QR코드의 스캔 기간은 주문 후 1년이며, 1년 이후에는 스캔하실 수 없습니다.
  </div>
  <div style="margin-bottom: 16px;">
    ※eSIM Profile을 삭제할 경우, 신규 eSIM을 주문해야만 사용할 수 있습니다.
  </div>
</div>

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #e2efd9; border: 1px solid #999; margin-bottom: 24px;">
  <tr>
    <td style="padding: 10px; font-weight: bold; text-align: left;">
      <a href="https://yconnectkorea.com/esim-install" target="_blank" style="color: black; text-decoration: underline; display: inline-block;">
        eSIM 설치 및 한국 도착해서 활성화 방법 상세 보기
      </a>
    </td>
  </tr>
</table>


<!-- ■ 음성/문자 수신과 발신 서비스까지 이용하는 방법 -->
<div style="font-weight: bold; font-size: 14px; margin-top: 20px;">
  ■ 음성/문자 수신과 발신 서비스까지 이용하는 방법
</div>

<div style="font-size: 14px; line-height: 1.6; color: #333; font-family: Arial, sans-serif;">
  <div style="color: red; font-weight: bold;">
    (※ Data 만 이용하실 분은 아래 절차가 필요 없습니다)
  </div>
  <div style="margin-bottom: 1px;">
    미국에서 eSIM을 먼저 설치하시고 한국 도착 후, 공항의 SKT 로밍센터를 방문해 주세요.
  </div>
  <div style="margin-bottom: 1px;">
    1. QR 코드 이메일(주문번호/렌털 계약 번호/ eSIM 010 전화번호) 제출
  </div>
  <div style="margin-bottom: 1px;">
    2. 본인 여권(여권 정보 진위 여부 확인) 제출
  </div>
  <div style="margin-bottom: 1px;">
    3. 음성/문자 발신용 금액 충전 (한국에서 사용 가능한 본인 신용카드로 결제)
  </div>
</div>

<!-- ■ 음성/문자 발신용 금액 충전 -->
<div style="font-weight: bold; font-size: 14px; margin-top: 20px; margin-bottom: 1px;">
  ■ 음성/문자 발신용 금액 충전
</div>

<div style="font-size: 14px; line-height: 1.6; color: #333; font-family: Arial, sans-serif;">
  <div style="margin-bottom: 1px;">
    ※ 음성/문자 발신은 금액 충전 시 이용이 가능하며, 음성/문자 수신은 무료로 이용이 가능합니다.
  </div>
</div>

<div style="text-align: right; font-size: 12px; margin-bottom: 5px; color: #555; font-family: Arial, sans-serif;">
  *부가세 포함
</div>

<table style="border-collapse: collapse; width: 100%; text-align: center; font-family: Arial, sans-serif; font-size: 13px;">
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

<!-- ■ 공항 SKT 로밍센터 안내 -->
<div style="font-weight: bold; font-size: 14px; margin-top: 24px; margin-bottom: 1px;">
  ■ 공항 SKT 로밍센터 안내
</div>

<div style="font-size: 14px; line-height: 1.6; color: #333; font-family: Arial, sans-serif; margin-bottom: 16px;">
  SKT 로밍센터를 방문하기 전에 장소와 근무시간을 확인하세요.
</div>

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #e2efd9; border: 1px solid #999; margin-bottom: 24px;">
  <tr>
    <td style="padding: 10px; font-weight: bold; text-align: left;">
      <a href="https://yconnectkorea.com/contact/#03" target="_blank" style="color: black; text-decoration: underline; display: inline-block;">
        SKT 로밍센터 상세 보기
      </a>
    </td>
  </tr>
</table>

<!-- ■ 온라인 여권 정보 진위 여부 확인 (외국 여권 소지자만 가능) -->
<div style="font-weight: bold; font-size: 14px; margin-top: 20px; margin-bottom: 1px;">
  ■ 온라인 여권 정보 진위 여부 확인 (외국 여권 소지자만 가능)
</div>

<div style="font-size: 14px; font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
  <div style="margin-bottom: 1px;">
    ※ Data 만 이용하실 분은 여권 정보 진위 여부 확인이 필요 없습니다.
  </div>
  <div style="color: red; font-weight: bold; margin-bottom: 1px;">
    ※ 대한민국 여권 보유자는 여권 정보 진위 여부 확인을 온라인에서 이용할 수 없습니다.
  </div>
  <div style="margin-bottom: 1px;">
    한국 출입국 관리소 통과 이후에, 매일 8시부터 22시까지 확인 가능합니다.
  </div>
  <div style="margin-bottom: 1px;">
    <strong>여권 정보 인증 페이지 접속:</strong><br>
    <a href="https://www.skroaming.com/passport/" target="_blank" style="color: #0645AD; text-decoration: underline;">
      https://www.skroaming.com/passport/
    </a>
  </div>
  <div style="margin-bottom: 1px;">
    ① 로그인 정보 입력:<br>
    렌털 계약 번호 / eSIM 010 전화번호 (이 정보는 QR 코드 이메일에 제공됩니다)
  </div>
  <div style="margin-bottom: 1px;">
    ② 여권정보 입력:<br>
    성 / 이름 / 여권번호 / 생년월일 / 국적 (여권상 표시와 동일해야 합니다)
  </div>
</div>

<!-- ■ 온라인 음성/문자 발신용 금액 충전 방법 -->
<div style="font-weight: bold; font-size: 14px; margin-top: 20px; margin-bottom: 1px;">
  ■ 온라인 음성/문자 발신용 금액 충전 방법
</div>

<div style="font-size: 14px; font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
  <div style="color: red; font-weight: bold; margin-bottom: 1px;">
    ※ 여권 정보 진위 여부 확인을 마치신 고객님에 한하여 이용할 수 있습니다.
  </div>

  <div style="margin-bottom: 1px;">
    <strong>음성/문자 충전 페이지 접속:</strong><br>
    <a href="https://www.skroaming.com/reservation/charging" target="_blank" style="color: #0645AD; text-decoration: underline;">
      https://www.skroaming.com/reservation/charging
    </a>
  </div>

  <div style="margin-bottom: 1px;">
    ① 로그인 정보 입력:<br>
    렌털 계약 번호 / eSIM 010 전화번호 (이 정보는 QR 코드 이메일에 제공됩니다)
  </div>

  <div style="margin-bottom: 1px;">
    ② 충전 금액 결정:<br>
    5,500원 / 11,000원 / 22,000원 / 33,000원 / 55,000원 (부가세 포함입니다)
  </div>

  <div style="margin-bottom: 1px;">
    ③ 결제 카드 입력:<br>
    충전 금액 결제 (한국에서 사용 가능한 신용카드로 결제하셔야 합니다)
  </div>
</div>

<hr style="margin: 30px 0; border: none; border-top: 1px solid #ccc;">

<!-- 맺음말 -->
<div style="font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6; font-weight: bold; margin-bottom: 20px;">
  주문 내역에 착오가 있거나, 그 외 궁금한 사항이 있으시면,<br>
  고객님 주문 정보와 함께 문의 사항을 적으셔서 
  <a href="mailto:contact@yconnectkorea.com" style="color: #0645AD; text-decoration: underline;">contact@yconnectkorea.com</a> 으로<br>
  이메일 보내 주시면 바로 답변 드리겠습니다.<br>
  다시 한번 Y Connect Korea SKT eSIM을 주문해 주심에 진심으로 감사드립니다.
</div>

<div style="margin-top: 16px;">
  <div style="font-family: Arial, sans-serif; font-size: 14px; font-weight: bold; line-height: 1.6; margin-bottom: 8px;">
    Y CONNECT KOREA<br>
    고객지원센터
  </div>
  <div style="font-family: Arial, sans-serif; font-size: 14px; margin-bottom: 30px;">
    <a href="mailto:contact@yconnectkorea.com" style="color: #0645AD; text-decoration: underline;">contact@yconnectkorea.com</a>
  </div>
</div>


</html>