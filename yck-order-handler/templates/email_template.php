<?php
// $mail_data는 yck_handle_order에서 온 $data 배열과 동일한 구조
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>[Y CONNECT KOREA] SKT USIM (Airport Pickup) Voucher</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6;">

<h2>Thank you for ordering Y CONNECT KOREA SKT USIM (Airport Pickup)</h2>

<p><strong>■ Reservation Number (Order ID)</strong></p>
<p><?= htmlspecialchars($mail_data['order_id']) ?></p>

<!-- 바코드 생성 -->
<?php if (!empty($mail_data['barcode_base64'])): ?>
  <p><img src="data:image/png;base64,<?= $mail_data['barcode_base64'] ?>" alt="Barcode" /></p>
<?php endif; ?>

<p>Upon arriving in Korea, please visit the SKT roaming center at the airport.</p>
<ul>
  <li>Submit this voucher (order number) and your passport.</li>
  <li>Recharge if you need outgoing calls or texts.</li>
</ul>

<p><strong>Reservation Details</strong></p>
<ul>
  <li><strong>First Name:</strong> <?= htmlspecialchars($mail_data['first_name']) ?></li>
  <li><strong>Last Name:</strong> <?= htmlspecialchars($mail_data['last_name']) ?></li>
  <li><strong>Email:</strong> <?= htmlspecialchars($mail_data['email']) ?></li>
  <li><strong>Phone:</strong> <?= htmlspecialchars($mail_data['phone']) ?></li>
  <li><strong>Device Model:</strong> <?= htmlspecialchars($mail_data['device_model']) ?></li>
  <li><strong>Arrival Date:</strong> <?= htmlspecialchars($mail_data['arrival_date']) ?></li>
  <li><strong>eSIM Days:</strong> <?= htmlspecialchars($mail_data['esim_day']) ?></li>
  <li><strong>Payment Date:</strong> <?= htmlspecialchars($mail_data['payment_date']) ?></li>
</ul>

<?php if (!empty($mail_data['order_items'])): ?>
  <h3>🛒 Ordered Items</h3>
  <ul>
    <?php foreach ($mail_data['order_items'] as $item): ?>
      <li><?= htmlspecialchars($item->get_name()) ?> x <?= $item->get_quantity() ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<hr>

<h2>Y CONNECT KOREA SKT USIM (공항픽업)을 주문해 주셔서 감사합니다.</h2>

<p><strong>■ 예약번호</strong></p>
<p><?= htmlspecialchars($mail_data['order_id']) ?></p>

<?php if (!empty($mail_data['barcode_base64'])): ?>
  <p><img src="data:image/png;base64,<?= $mail_data['barcode_base64'] ?>" alt="바코드" /></p>
<?php endif; ?>

<p>한국 도착 후 공항 SKT 로밍센터를 방문해 주세요.</p>
<ol>
  <li>이 바우처(주문번호)와 여권을 제출하세요.</li>
  <li>음성/문자 발신이 필요하신 경우 충전 후 이용하실 수 있습니다.</li>
</ol>

<p><strong>예약 정보</strong></p>
<ul>
  <li><strong>이름:</strong> <?= htmlspecialchars($mail_data['first_name']) ?> <?= htmlspecialchars($mail_data['last_name']) ?></li>
  <li><strong>이메일:</strong> <?= htmlspecialchars($mail_data['email']) ?></li>
  <li><strong>전화번호:</strong> <?= htmlspecialchars($mail_data['phone']) ?></li>
  <li><strong>기기 모델:</strong> <?= htmlspecialchars($mail_data['device_model']) ?></li>
  <li><strong>도착일:</strong> <?= htmlspecialchars($mail_data['arrival_date']) ?></li>
  <li><strong>사용일수:</strong> <?= htmlspecialchars($mail_data['esim_day']) ?>일</li>
  <li><strong>결제일:</strong> <?= htmlspecialchars($mail_data['payment_date']) ?></li>
</ul>

<?php if (!empty($mail_data['order_items'])): ?>
  <h3>🛒 주문 항목</h3>
  <ul>
    <?php foreach ($mail_data['order_items'] as $item): ?>
      <li><?= htmlspecialchars($item->get_name()) ?> x <?= $item->get_quantity() ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<p>📍 <a href="https://yconnectkorea.com/sktroamingcenter" target="_blank">SKT 로밍센터 안내 보기</a></p>
<p>🔌 <a href="https://www.skroaming.com/reservation/charging" target="_blank">음성/문자 충전 페이지</a></p>

<p>문의: <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a></p>

</body>
</html>
