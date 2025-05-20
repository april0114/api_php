<?php
require_once WP_PLUGIN_DIR . '/yck-order-handler/includes/barcode128.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>[Y CONNECT KOREA] This is the voucher email for the SKT USIM (Airport Pickup) you ordered</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.6; }
    h2 { color: #000080; }
    .highlight { color: red; font-weight: bold; }
    .box-link {
      background-color: #e0ffe0;
      border: 1px solid #a0dca0;
      padding: 10px;
      margin: 10px 0;
    }
    .section-title { font-weight: bold; margin-top: 20px; }
    table { border-collapse: collapse; margin: 10px 0; width: 100%; }
    td, th { border: 1px solid #ccc; padding: 8px; text-align: left; }
    .green-box { background-color: #e0ffe0; border: 1px solid #009900; padding: 8px; }
    .red-text { color: red; font-weight: bold; }
  </style>
</head>
<body>

<h2>[Y CONNECT KOREA] This is the voucher email for the SKT USIM (Airport Pickup) you ordered</h2>

<p>
  <a href="https://yconnectkorea.com" target="_blank">
    <img src="https://yconnectkorea.com/wp-content/uploads/2025/04/YCK_logo_01.png" alt="Y CONNECT KOREA Logo" style="max-width: 200px; display: block; margin: 20px 0;">
  </a>
</p>

<p>Thank you very much for ordering the <strong>Y CONNECT KOREA SKT USIM (Airport Pickup)</strong>.</p>

<h3>■ SKT USIM (Airport Pickup) Barcode for Pickup (Order Number)</h3>
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


<p>Upon arriving in Korea, please visit the SKT roaming center at the airport.</p>
<ol>
  <li>Submit the barcode (order number) of this voucher and your passport.</li>
  <li>If you need to make outgoing voice/texts, charge the amount for outgoing voice/texts.</li>
</ol>
<p>Once your passport verification and charging (if needed) are complete, you will receive your SKT SIM card.</p>
<ul>
  <li>You must pay with your credit card that can be used in Korea.</li>
  <li>If there are many customers waiting, you may be asked to charge the amount for outgoing voice/texts online.</li>
</ul>

<h3>■ SKT USIM (Airport Pickup) Reservation Information</h3>
<table>
  <tr><th>Last Name / First Name</th><td><?= htmlspecialchars($mail_data['last_name']) ?> <?= htmlspecialchars($mail_data['first_name']) ?></td></tr>
  <tr><th>Mobile Number</th><td><?= htmlspecialchars($mail_data['mobile_number']) ?></td></tr>
  <tr><th>Mobile Model Name</th><td><?= htmlspecialchars($mail_data['device_model']) ?></td></tr>
  <tr><th>Arrival Date in Korea / Arrival Time</th><td><?= htmlspecialchars($mail_data['arrival_date']) ?></td></tr>
  <tr><th>Pickup / Passport Verification / Charge</th><td>Incheon International Airport (Terminal 1)</td></tr>
  <tr><th>Usage Days</th><td><?= htmlspecialchars(implode(', ', (array)$mail_data['usage_days'])) ?> days</td></tr>
</table>

<h3>■ Charge Amount of Voice/Texts</h3>
<p>※ Outgoing voice/text can be used when the amount is charged, and incoming voice/text is free of charge.</p>

<h3>■ SKT Roaming Center at the Airport</h3>
<p>Please, check the location and working time before visiting the SKT roaming center.</p>
<div class="green-box">
  ▶ <a href="https://yconnectkorea.com/sktroamingcenter" target="_blank">View Details: SKT roaming center</a>
</div>

<h3>■ Online Recharge Amount of Voice/Texts</h3>
<p>Access the charge amount of voice/texts page:</p>
<ol>
  <li><a href="https://www.skroaming.com/reservation/charging" target="_blank">https://www.skroaming.com/reservation/charging</a></li>
  <li>Enter login information:<br>Rental contract number / eSIM 010 phone number (This information will be provided at the SKT roaming center when you pick up your SIM card)</li>
  <li>Decide on recharge amount:<br>₩5,500 / ₩11,000 / ₩22,000 / ₩33,000 / ₩55,000 (VAT is included)</li>
  <li>Enter Payment Card Information:<br>You must pay with your credit card that can be used in Korea.</li>
</ol>

<p>If there are any errors in your order details, or if there are any changes to the SIM card pickup location/date, please send an email to <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a> with your order details and inquiry, and we will respond promptly.</p>

<p>Once again, we sincerely thank you for ordering a Y Connect Korea SKT USIM (Airport Pickup).</p>

<p><strong>Y CONNECT KOREA, INC.<br>
Customer Support<br>
<a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a></strong></p>

</body>
</html>
