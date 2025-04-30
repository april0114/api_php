<p>Order ID: <?= htmlspecialchars($order_id) ?></p>
<p>Buyer Name: <?= htmlspecialchars($buy_user_name) ?></p>
<p>Buyer Email: <?= htmlspecialchars($buy_user_email) ?></p>
<p>Product Type: <?= htmlspecialchars($product_type) ?></p>
<p>Product Days: <?= htmlspecialchars($product_days) ?> days</p>
<p>Payment Date: <?= htmlspecialchars($payment_date) ?></p>
<p>Apply Start Date: <?= htmlspecialchars($apply_start_date) ?></p>
<p>Apply End Date: <?= htmlspecialchars($apply_end_date) ?></p>

<!-- 바코드 삽입 -->
<img src="data:image/png;base64,<?= htmlspecialchars($barcode_base64) ?>" alt="Order Barcode" style="width:250px;height:auto;">
