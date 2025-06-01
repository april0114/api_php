<?php
#require_once WP_PLUGIN_DIR . '/yck-order-handler/includes/barcode128.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>[Y CONNECT KOREA] SKT uSIM pickup</title>
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

    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 10px; text-align: center;" colspan="2">
      Reservation Number (Order Number): <strong><?= htmlspecialchars($mail_data['order_id']) ?></strong>
    </td>
  </tr>
</table>


<p><strong>Upon arriving in Korea, please visit the SKT roaming center at the airport. </strong></p>
<p><strong>(1) Submit the barcode (order number) of this voucher and your passport. <br>(2) Also, if you need to make outgoing voice/texts, charge the amount for outgoing voice/texts.
<br>Once your passport verification and charging (if needed) are complete, you will receive your SKT SIM card.</strong></p>
<p class="red-text">※ You must pay with your credit card that can be used in Korea.<br> 
※ If there are many customers waiting, you may be asked to charge the amount for outgoing voice/texts through online.</p>


<div class="section-title">■ SKT USIM (Airport Pickup) Reservation Information</div>
<table style="border-collapse: collapse; width: 100%; table-layout: fixed;">
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Last Name / First Name</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;"><?= htmlspecialchars($mail_data['last_name']) ?> <?= htmlspecialchars($mail_data['first_name']) ?></td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Mobile Number</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">+1 <?= htmlspecialchars($mail_data['mobile_number']) ?></td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Mobile Model Name</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;"><?= htmlspecialchars($mail_data['device_model']) ?></td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Arrival Date in Korea / Arrival Time</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;"><?= htmlspecialchars($formatted_date) ?></td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; color: red;">Pickup / Passport Verification / Charge</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; color: red;">Incheon International Airport (Terminal 1)</td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Usage Days</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;"><?= htmlspecialchars(implode(', ', (array)$mail_data['usage_days'])) ?> days</td>
  </tr>
</table>

<div class="section-title">■ Charge Amount of Voice/Texts</div>
<p>※ Outgoing voice/text can be used when the amount is charged, and incoming voice/text is free of charge.</p>
<div style="text-align: right; font-size: 12px; margin-bottom: 5px;">*VAT is included</div>


<table style="border-collapse: collapse; width: 100%; text-align: center;">
  <tr style="background-color: #fff0b3;">
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">Charge amount</th>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩5,500</th>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩11,000</th>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩22,000</th>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩33,000</th>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩55,000</th>
  </tr>
  <tr style="background-color: #e2efd9;">
    <td style="border: 1px solid #ccc;border-top: 2px solid #333; padding: 10px;">Minute</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">About 20 minutes</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">About 40 minutes</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">About 80 minutes</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">About 120 minutes</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">About 200 minutes</td>
  </tr>
</table>

<div class="section-title">■ SKT Roaming Center at the Airport</div>
<p>Please, check the location and working time before visiting the SKT roaming center.</p>

<div class="box-link" style="text-align: center; font-weight: bold;">
  <a href="https://yconnectkorea.com/esim-install" target="_blank" style="color: black; text-decoration: none;">
   View Details: SKT roaming center
  </a>
</div>

<div class="section-title">■ Online Recharge Amount of Voice/Texts </div>

<p><strong>Access the charge amount of voice/texts page: </strong>  <a href="https://www.skroaming.com/reservation/charging" target="_blank">https://www.skroaming.com/reservation/charging</a> </p>
<p>① Enter login information:<br>
Rental contract number / eSIM 010 phone number (This information will be provided at the SKT roaming center when you pick up your SIM card)</p>
<p>② Decide on recharge amount:<br>
₩5,500 / ₩11,000 / ₩22,000 / ₩33,000 / ₩55,000 (VAT is included) </p>
<p>③ Enter Payment Card Information:<br>
You must pay with your credit card that can be used in Korea.</p>

<hr>

<div class="section-title">
If there are any errors in your order details, or if there are any changes to the SIM card pickup location/date,<br>
please send an email to contact@yconnectkorea.com with your order details and inquiry, and we will respond promptly. <br>
Once again, we sincerely thank you for ordering a Y Connect Korea SKT USIM (Airport Pickup).<br>
</div>

<div class="section-title">
Y CONNECT KOREA, INC. <br>
Customer Support
</div>
<p><a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a></p>

</body>
</html>
