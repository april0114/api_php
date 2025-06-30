<?php
/**
 * 관리자 알림용 이메일 템플릿 (USIM 주문 오류)
 * 사용 조건: API 실패 시
 */
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>[YCK 알림] USIM 주문 API 실패 - 수동 등록 필요</title>
  <style>
    body {
      font-family: 'Apple SD Gothic Neo', 'Noto Sans KR', Arial, sans-serif;
      font-size: 15px;
      color: #333;
      line-height: 1.6;
      background-color: #f9fafb;
      padding: 24px;
    }
    .container {
      background-color: #fff;
      padding: 24px;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
      max-width: 700px;
      margin: 0 auto;
    }
    h2 {
      font-size: 20px;
      color: #b91c1c;
      margin-bottom: 12px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin: 16px 0;
      font-size: 14px;
    }
    th, td {
      padding: 10px;
      border: 1px solid #e5e7eb;
      background-color: #f9fafb;
      text-align: left;
    }
    th {
      width: 140px;
      background-color: #f3f4f6;
      color: #111827;
      font-weight: 600;
    }
    .warning-box {
      background-color: #fef2f2;
      border: 1px solid #fca5a5;
      padding: 16px;
      border-radius: 6px;
      margin-top: 20px;
      color: #991b1b;
    }
    .warning-box strong {
      color: #b91c1c;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>[Y CONNECT KOREA] 주문 API 전송 실패 알림</h2>

  <p>다음 주문이 <strong>API 전송에 실패</strong>했습니다. 즉시 확인 바랍니다.</p>

  <h3>■ 주문 정보</h3>
  <table>
    <tr><th>주문번호</th><td><?= htmlspecialchars($mail_data['order_id']) ?></td></tr>
    <tr><th>고객명</th><td><?= htmlspecialchars($mail_data['first_name']) ?> <?= htmlspecialchars($mail_data['last_name']) ?></td></tr>
    <tr><th>이메일</th><td><?= htmlspecialchars($mail_data['email']) ?></td></tr>
    <tr><th>결제일시</th><td><?= htmlspecialchars($mail_data['payment_date']) ?></td></tr>
  </table>

  <h3>■ 오류 정보</h3>
  <table>
    <tr><th>에러 코드</th><td><?= htmlspecialchars($error_code ?? '-') ?></td></tr>
    <!--<tr><th>에러 사유</th><td><?= htmlspecialchars($error_reason ?? '제공되지 않음') ?></td></tr>-->
  </table>

  <div class="warning-box">
    ⚠️ 이 주문은 <strong>관리자 확인</strong>이 필요합니다.<br>
    고객에게 QR/바코드 발송 여부도 반드시 재확인 바랍니다.
  </div>
</div>

</body>
</html>
