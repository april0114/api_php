
<!--<p>Order ID: <?= htmlspecialchars($order_id) ?></p>
<p>Buyer Name: <?= htmlspecialchars($buy_user_name) ?></p>
<p>Buyer Email: <?= htmlspecialchars($buy_user_email) ?></p>
<p>Product Type: <?= htmlspecialchars($product_type) ?></p>
<p>Product Days: <?= htmlspecialchars($product_days) ?> days</p>
<p>Payment Date: <?= htmlspecialchars($payment_date) ?></p>
<p>Apply Start Date: <?= htmlspecialchars($apply_start_date) ?></p>
<p>Apply End Date: <?= htmlspecialchars($apply_end_date) ?></p>-->

<html>
<body>
  
    <p>Thank you very much for ordering the Y CONNECT KOREA SKT USIM (Airport Pickup).</p>

    <h3>■ SKT USIM (Airport Pickup) Barcode for Pickup (Order Number)</h3>
    <p><img src="data:image/png;base64,<?= $barcode_base64 ?>" alt="Order Barcode" /></p>
    <p>Reservation Number (Order Number): <strong><?= htmlspecialchars($order_id) ?></strong></p>

    <p>Upon arriving in Korea, please visit the SKT roaming center at the airport.</p>
    <ol>
        <li>Submit the barcode (order number) of this voucher and your passport.</li>
        <li>Charge the amount for outgoing voice/texts if needed.</li>
    </ol>

    <h3>■ SKT USIM (Airport Pickup) Reservation Information</h3>
    <p>Name: <strong><?= htmlspecialchars($buy_user_name) ?></strong></p>
    <p>Mobile Number: <strong><?= htmlspecialchars($mobile_number) ?></strong></p>
    <p>Mobile Model Name: <strong><?= htmlspecialchars($mobile_model) ?></strong></p>
    <p>Arrival Date in Korea / Arrival Time: <strong><?= htmlspecialchars($arrival_date) ?></strong></p>
    <p>Pickup Location: <strong><?= htmlspecialchars($pickup_location) ?></strong></p>
    <p>Usage Days: <strong><?= htmlspecialchars($usage_days) ?> days</strong></p>

    <hr>

    <!-- 한국어 버전 시작 -->
    <p>Y CONNECT KOREA SKT USIM (Airport Pickup)을 주문해 주셔서 진심으로 감사드립니다.</p>

    <h3>■ SKT USIM (Airport Pickup) 픽업을 위한 바코드</h3>
    <p><img src="data:image/png;base64,<?= $barcode_base64 ?>" alt="Order Barcode" /></p>
    <p>예약번호(주문번호): <strong><?= htmlspecialchars($order_id) ?></strong></p>

    <p>한국 도착해서 공항 SKT 로밍센터를 방문해 주세요.</p>
    <ol>
        <li>본 바우처의 바코드(주문번호)와 고객님 여권을 제시해 주세요.</li>
        <li>음성/문자 발신용 금액 충전이 필요한 경우, 충전 후 SIM 카드를 수령하실 수 있습니다.</li>
    </ol>

    <h3>■ SKT USIM (Airport Pickup) 예약 정보</h3>
    <p>성 / 이름: <strong><?= htmlspecialchars($last_name) ?> <?= htmlspecialchars($first_name) ?></strong></p>
    <p>모바일 번호: <strong><?= htmlspecialchars($mobile_number) ?></strong></p>
    <p>모바일 모델명: <strong><?= htmlspecialchars($mobile_model) ?></strong></p>
    <p>한국 도착일 / 도착시간: <strong><?= htmlspecialchars($arrival_date) ?></strong></p>
    <p>픽업 장소: <strong><?= htmlspecialchars($pickup_location) ?></strong></p>
    <p>사용일 수: <strong><?= htmlspecialchars($usage_days) ?>일</strong></p>

    <hr>

    <p>If you have any errors or changes, please contact <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a>.</p>
</body>
</html>


