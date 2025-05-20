<?php
/**
 * 관리자 알림용 이메일 템플릿 (USIM 주문 오류 - 수동 등록 필요)
 * 사용 조건: API result === -9
 */
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>[YCK 알림] USIM 주문 API 실패 - 수동 등록 필요</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6; }
    table { border-collapse: collapse; margin: 20px 0; width: 100%; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    .warning { background-color: #fff0f0; padding: 12px; border-left: 4px solid #d00; margin: 20px 0; }
  </style>
</head>
<body>

<h2>[Y CONNECT KOREA] USIM 주문 API 전송 실패 알림</h2>

<p>다음 USIM 주문이 <strong>서버 점검 시간 중에 결제</strong>되어, <strong>API 전송에 실패</strong>했습니다.</p>

<h3>■ 주문 정보</h3>
<table>
  <tr><th>주문번호</th><td><?= htmlspecialchars($mail_data['order_id']) ?></td></tr>
  <tr><th>고객명</th><td><?= htmlspecialchars($mail_data['first_name']) ?> <?= htmlspecialchars($mail_data['last_name']) ?></td></tr>
  <tr><th>이메일</th><td><?= htmlspecialchars($mail_data['email']) ?></td></tr>
  <tr><th>결제일시</th><td><?= htmlspecialchars($mail_data['payment_date']) ?></td></tr>
</table>

<div class="warning">
  ※ 이 주문은 DB에 저장되지 않았으므로 <strong>관리자 수동 등록</strong>이 필요합니다.<br>
  즉시 확인 바랍니다.
</div>


</body>
</html>
