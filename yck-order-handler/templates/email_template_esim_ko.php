<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>[Y CONNECT KOREA] This is the installation and activation guide email for the SKT eSIM you ordered</title>
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

<h2>[Y CONNECT KOREA] 한글 테스트</h2>

<img src="https://yconnectkorea.com/wp-content/uploads/2025/04/YCK_logo_01.png" alt="Y CONNECT KOREA Logo" style="max-width: 200px; display: block; margin: 20px 0;">

<p>Thank you very much for ordering the <strong>Y CONNECT KOREA SKT eSIM</strong>.<br>
This guide email has been sent to assist you with your eSIM installation and mobile phone usage in Korea.<br>
Once your order is complete, you should receive an email containing a QR code separately from this installation guide email.</p>

<p class="highlight">If you do not receive the QR code email (in English) from our Korean partner within 24 hours after placing your order:</p>
<ol>
  <li>Please check your email's spam folder or promotions tab.</li>
  <li>If you still do not receive the QR code after checking the above 1, please send an email to <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a> with <strong>QR Code Not Received</strong>, and include your name, phone number, and order number. We will process your request immediately.</li>
</ol>

<div class="section-title">■ SKT eSIM Reservation Number (Order Number)</div>
<p><strong>Reservation Number:</strong> <?= htmlspecialchars($mail_data['order_id']) ?></p>

<div class="section-title">■ SKT eSIM Reservation Information</div>
<table>
  <tr><th>Last Name / First Name</th><td><?= htmlspecialchars($mail_data['last_name']) ?> <?= htmlspecialchars($mail_data['first_name']) ?></td></tr>
  <tr><th>Mobile Number</th><td><?= htmlspecialchars($mail_data['mobile_number']) ?></td></tr>
  <tr><th>Mobile Model Name</th><td><?= htmlspecialchars($mail_data['device_model']) ?></td></tr>
  <tr><th>Arrival Date in Korea</th><td><?= htmlspecialchars($mail_data['arrival_date']) ?></td></tr>
  <tr><th>Pickup / Passport Verification / Charge</th><td>Incheon International Airport (Terminal 1)</td></tr>
  <tr><th>Usage Days</th><td><?= htmlspecialchars(implode(', ', (array)$mail_data['usage_days'])) ?> days</td></tr>
</table>

<div class="section-title">■ eSIM Installation and Activation</div>
<ul>
  <li>This eSIM QR code can be scanned within one year after the order and it cannot be scanned after one year.</li>
  <li>If you delete the eSIM profile, you will need to order a new eSIM to use it.</li>
</ul>
<div class="box-link">
  ▶ <a href="https://yconnectkorea.com/esim-install" target="_blank">View Details: How to install eSIM by scanning QR code and Activate eSIM in Korea</a>
</div>

<div class="section-title">■ How to Use Incoming/Outgoing Voice/Texts</div>
<p class="red-text">※ If you only need data, the following steps are not required.</p>
<ol>
  <li>Install the eSIM on your phone before arriving in Korea.</li>
  <li>Visit the SKT roaming center at the airport.</li>
  <li>Present the QR code email and submit your passport for verification.</li>
  <li>Charge the amount for outgoing voice/texts (use a credit card usable in Korea).</li>
</ol>

<div class="section-title">■ Charge Amount of Voice/Texts</div>
<table>
  <tr><th>Charge amount</th><th>₩5,500</th><th>₩11,000</th><th>₩22,000</th><th>₩33,000</th><th>₩55,000</th></tr>
  <tr><td>Minute</td><td>About 20 minutes</td><td>About 40 minutes</td><td>About 80 minutes</td><td>About 120 minutes</td><td>About 200 minutes</td></tr>
</table>

<div class="section-title">■ SKT Roaming Center at the Airport</div>
<p>Please, check the location and working time before visiting the SKT roaming center.</p>
<div class="green-box">
  ▶ <a href="https://yconnectkorea.com/sktroamingcenter" target="_blank">View Details: SKT roaming center</a>
</div>

<div class="section-title">■ Online Passport Information Verification (Only Available for Foreign Passport Holders)</div>
<p>※ For data-only users, passport verification is not required.<br>
<span class="red-text">※ A passport issued by the Republic of Korea cannot be used for online passport verification.</span></p>
<p>Online verification is available daily from 8:00 AM to 10:00 PM after passing through immigration.</p>
<ol>
  <li>Access: <a href="https://www.skroaming.com/passport/" target="_blank">https://www.skroaming.com/passport/</a></li>
  <li>Login: Rental contract number / eSIM 010 phone number</li>
  <li>Enter your passport information (name, number, DOB, nationality)</li>
</ol>

<div class="section-title">■ Online Charge Amount of Voice/Texts</div>
<p class="red-text">※ Only customers who have completed passport information verification can charge online.</p>
<ol>
  <li>Access: <a href="https://www.skroaming.com/reservation/charging" target="_blank">https://www.skroaming.com/reservation/charging</a></li>
  <li>Login and select charge amount</li>
  <li>Enter payment card info (usable in Korea)</li>
</ol>

<hr>

<p>문의: <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a></p>

</body>
</html>