<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>[Y CONNECT KOREA] This is the installation and activation guide email for the SKT eSIM you ordered</title>
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
    .inline-block-fix > * {
    display: inline;
  }

  </style>
</head>
<body>

<a href="https://yconnectkorea.com" target="_blank">
  <img src="https://yconnectkorea.com/wp-content/uploads/2025/04/YCK_logo_01.png" 
       alt="Y CONNECT KOREA Logo" 
       style="max-width: 200px; display: block; margin: 20px 0;">
</a>
<p><strong>Thank you very much for ordering the Y CONNECT KOREA SKT eSIM.<br><br>
This guide email has been sent to assist you with your eSIM installation and mobile phone usage in Korea.
Once your order is complete, you should receive an email containing a QR code separately from this installation guide email.
.<br>

<p class="highlight">If you do not receive the QR code email (in English) from our Korean partner within 24 hours after placing your order:</p>

 <p><strong>1. Please check your email's spam folder or promotions tab.</strong></p>
  <p><strong>2. If you still do not receive the QR code after checking the above 1,<br>please send an email to
  <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a>with QR Code Not Received, and include your name, phone number, and order number. We will process your request immediately.</strong></p>


<div?php
$raw_date = $mail_data['arrival_date'] ?? '';
$formatted_date = '';

try {
    $date = DateTime::createFromFormat('d/m/Y', $raw_date);
    if ($date !== false) {
        $formatted_date = $date->format('Y-m-d');
    }
} catch (Exception $e) {
    $formatted_date = $raw_date; 
}
?>

<!-- ■ SKT eSIM 예약번호(주문번호) -->
<div class="section-title">■ SKT eSIM Reservation Number (Order Number)</div>
<table style="border-collapse: collapse; width: 100%; table-layout: fixed;">
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; width: 50%;">
      Reservation Number<br>(Order Number)

    </td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; width: 50%;">
      <?= htmlspecialchars($mail_data['order_id']) ?>
    </td>
  </tr>
</table>

<!-- ■ SKT eSIM 예약정보 -->
<div class="section-title">■ SKT eSIM Reservation Information</div>
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
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Arrival Date in Korea</td>
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



<div class="section-title">■ eSIM Installation and Activation</div>
<div class="inline-block-fix">
<p>※ This eSIM QR codes can be scanned within one year after the order and it cannot be scanned after one year.<br>
※ If you delete the eSIM profile, you will need to order a new eSIM to use it.
</p>
</div>
<div class="box-link" style="text-align: center; font-weight: bold;">
  <a href="https://yconnectkorea.com/esim-install" target="_blank" style="color: black; text-decoration: none;">
    View Details: How to install eSIM by scanning QR code and Activate eSIM in Korea
  </a>
</div>
<div class="section-title">■ How to Use Incoming/Outgoing Voice/Texts</div>
<div class="inline-block-fix">
<p class="red-text">※ If you only need data, the following steps are not required.</p><br>
<p>Before arriving in Korea, please install the eSIM on your phone.<br>Then, visit the SKT roaming center at the airport.</p><br>
<p>1. Present the QR code email (order number /rental contract number / eSIM 010 phone number) </p><br>
 <p>2. Submit your passport to verify passport information.</p><br>
<p>3. Charge the amount for outgoing voice/texts (You must pay with your credit card that can be used in Korea).</p>
</div>

<div class="section-title">■ Charge Amount of Voice/Texts</div>
<div class="inline-block-fix">
<p>※ Outgoing voice/text can be used when the amount is charged, and incoming voice/text is free of charge.</p></div>
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
<div class="inline-block-fix">
<p>Please, check the location and working time before visiting the SKT roaming center.</p>
</div>

<div class="box-link" style="text-align: center; font-weight: bold;">
  <a href="https://yconnectkorea.com/esim-install" target="_blank" style="color: black; text-decoration: none;">
    View Details: SKT roaming center
  </a>
</div>

<div class="section-title">■ Online Passport Information Verification (Only Available for Foreign Passport Holders)</div>
<div class="inline-block-fix">
<p>※ For those using data only, passport information verification is not required.</p><br>
<p style="color: red;">※ A passport issued by the Republic of Korea cannot be used cannot use online passport information verification.</p><br>
<p>Online passport information verification is available daily from 8:00 AM to 10:00 PM after passing through Korean immigration. </p><br>
<p>
  <strong>Access the passport information verification page: https://www.skroaming.com/passport/</strong> 
  <a href="https://www.skroaming.com/passport/" target="_blank">https://www.skroaming.com/passport/</a><br>
</p>

<p>① Enter login information:<br>
Rental contract number / eSIM 010 phone number (This information will be provided on your QR code email)</p><br>

<p>② Enter your passport information:<br>
Last name / First name / Passport number / Date of birth / Nationality (must match the information on your passport)
</p>
</div>


<div class="section-title">■ Online Charge Amount of Voice/Texts</div>
<div class="inline-block-fix">
<p style="color: red;">※ Only customers who have completed passport information verification can charge online.</p><br>

 <p><strong>Access the charge amount of voice/texts page:</strong>  <a href="https://www.skroaming.com/reservation/charging" target="_blank">https://www.skroaming.com/reservation/charging</a> </p><br>
<p>① Enter login information:<br>
Rental contract number / eSIM 010 phone number (This information will be provided on your QR code email)</p><br>
<p>② Decide on charge amount:<br>
₩5,500 / ₩11,000 / ₩22,000 / ₩33,000 / ₩55,000 (VAT is included) </p><br>
<p>③ Enter Payment Card Information:<br>
You must pay with your credit card that can be used in Korea.</p><br>
</div>
<br>
<hr>
<div class="section-title">
If there are any errors in your order details, or if you have any questions, <br>
please send an email to contact@yconnectkorea.com with your order details and inquiry, and we will respond promptly.<br>
Once again, we sincerely thank you for ordering a Y Connect Korea SKT eSIM.
</div>
<div class="inline-block-fix">
<div class="section-title">
    <br>
Y CONNECT KOREA<br>
Customer Support<br>
</div>
<p><a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a></p>
</div>
</body>
</html>
