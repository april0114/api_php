<html>
<body style="font-family: Arial, sans-serif; color: #333;">
    <p>Thank you very much for ordering the Y CONNECT KOREA SKT USIM (Airport Pickup).</p>

    <h3>■ SKT USIM (Airport Pickup) Barcode for Pickup (Order Number)</h3>
    <p><img src="data:image/png;base64,<?= $barcode_base64 ?>" alt="Order Barcode" style="width:250px; height:auto;"/></p>
    <p>Reservation Number (Order Number): <strong><?= htmlspecialchars($order_id) ?></strong></p>

    <p>Upon arriving in Korea, please visit the SKT roaming center at the airport.</p>
    <ol>
        <li>Submit the barcode (order number) of this voucher and your passport.</li>
        <li>Charge the amount for outgoing voice/texts if needed.</li>
    </ol>

    <h3>■ SKT USIM (Airport Pickup) Reservation Information</h3>
    <ul>
        <li>Last Name / First Name: <strong><?= htmlspecialchars($last_name) ?> <?= htmlspecialchars($first_name) ?></strong></li>
        <li>Mobile Number: <strong><?= htmlspecialchars($mobile_number) ?></strong></li>
        <li>Mobile Model Name: <strong><?= htmlspecialchars($mobile_model) ?></strong></li>
        <li>Arrival Date in Korea / Arrival Time: <strong><?= htmlspecialchars($arrival_date) ?></strong></li>
        <li>Pickup Location: <strong><?= htmlspecialchars($pickup_location) ?></strong></li>
        <li>Usage Days: <strong><?= htmlspecialchars($usage_days) ?> days</strong></li>
    </ul>

    <hr>

    <!-- 한국어 버전 시작 -->
    <p>Y CONNECT KOREA SKT USIM (Airport Pickup)을 주문해 주셔서 진심으로 감사드립니다.</p>

    <h3>■ SKT USIM (Airport Pickup) 픽업을 위한 바코드</h3>
    <p><img src="data:image/png;base64,<?= $barcode_base64 ?>" alt="주문 바코드" style="width:250px; height:auto;"/></p>
    <p>예약번호(주문번호): <strong><?= htmlspecialchars($order_id) ?></strong></p>

    <p>한국 도착 후 공항 SKT 로밍센터를 방문해 주세요.</p>
    <ol>
        <li>본 바우처의 바코드(주문번호)와 여권을 제시해 주세요.</li>
        <li>음성/문자 발신이 필요하면 별도 금액을 충전 후 SIM 카드를 수령하세요.</li>
    </ol>

    <h3>■ SKT USIM (Airport Pickup) 예약 정보</h3>
    <ul>
        <li>성 / 이름: <strong><?= htmlspecialchars($last_name) ?> <?= htmlspecialchars($first_name) ?></strong></li>
        <li>모바일 번호: <strong><?= htmlspecialchars($mobile_number) ?></strong></li>
        <li>모바일 모델명: <strong><?= htmlspecialchars($mobile_model) ?></strong></li>
        <li>한국 도착일 / 도착시간: <strong><?= htmlspecialchars($arrival_date) ?></strong></li>
        <li>픽업 장소: <strong><?= htmlspecialchars($pickup_location) ?></strong></li>
        <li>사용일 수: <strong><?= htmlspecialchars($usage_days) ?>일</strong></li>
    </ul>

    <hr>

    <p>If there are any errors or changes, please contact <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a>.</p>
</body>
</html>
