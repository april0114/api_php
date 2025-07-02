<!-- templates/email_template_usim_en.php -->
<?php
require_once WP_PLUGIN_DIR . '/yck-order-handler/includes/barcode128.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <!--CSS-->
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      color: #333;
      line-height: 1.6;
    }

    h2 {
      color: #000080;
    }

    .highlight {
      color: red;
      font-weight: bold;
    }

    .box-link {
      background-color: #e2efd9;
      border: 1px solid #999;
      padding: 10px;
      margin: 10px 0;
    }

    .section-title {
      font-weight: bold;
      margin-top: 20px;
    }

    table {
      border-collapse: collapse;
      margin: 10px 0;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }

    .green-box {
      background-color: #e2efd9;
      border: 1px solid #999;
      padding: 8px;
    }

    .red-text {
      color: red;
      font-weight: bold;
    }

    .inline-block-fix>* {
      display: inline;
    }
    
      body, table, td, div, p, a {
    font-family: Arial, sans-serif;
    line-height: 1.5;
    font-size: 14px;
    color: #333;
    margin: 0;
    padding: 0;
  }
  p {
    margin: 0;
    padding: 0;
  }
  </style>
</head>

<!-- 로고 이미지-->

<body>
 <p>
  <a href="http://yconnectkorea.com/en/" target="_blank">
    <img src="https://yconnectkorea.com/wp-content/uploads/2025/04/YCK_logo_01.png" alt="Y CONNECT KOREA Logo"
      style="max-width: 200px; display: block; margin: 20px 0;">
  </a>
</p>

<div style="font-weight: bold; font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
  Thank you very much for ordering the Y CONNECT KOREA SKT USIM (Airport Pickup)
</div>

<div class="section-title" style="font-weight: bold; font-size: 14px; margin-bottom: 1px;">
  ■ SKT USIM (Airport Pickup) Barcode for Pickup (Order Number)
</div>

<!-- ■ SKT 바코드 -->
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

<!-- 안내 문구 부분 -->
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    <strong>After arriving in Korea, please visit the SKT Roaming Center at the airport.</strong>
  </div>

  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    <strong>(1)</strong> Submit the barcode (order number) of this voucher and your passport.
  </div>

  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    <strong>(2)</strong>If you need to make outgoing voice/texts, charge the amount for outgoing voice/texts.
  </div>

  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
Once your passport information is verified and charging is completed, you can receive your SKT SIM card.
  </div>

  <div style="font-size: 14px; line-height: 1.6; color: red; font-weight: bold; margin-bottom: 1px;">
    ※ You must pay with your credit card that can be used in Korea.<br>
    ※ If there are many customers waiting at the SKT roaming center, you may be requested to charge for outgoing voice/texts online.
  </div>



  <!-- ■ SKT USIM (Airport Pickup) Reservation Information -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ SKT USIM (Airport Pickup) Reservation Information
</div>

<table style="border-collapse: collapse; width: 100%; table-layout: fixed; margin-bottom: 1px;">
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Last Name / First Name</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
      <?= htmlspecialchars($mail_data['last_name']) ?> <?= htmlspecialchars($mail_data['first_name']) ?>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Mobile Number</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">+1
      <?= htmlspecialchars($mail_data['mobile_number']) ?>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Mobile Model Name</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
      <?= htmlspecialchars($mail_data['device_model']) ?>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Arrival Date in Korea</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
      <?= htmlspecialchars($mail_data['arrival_date']) ?>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; color: red;">Pickup / Passport Verification / Charge</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; color: red;">
      <?= htmlspecialchars($mail_data['pickup_location']) ?>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">Usage Days</td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle;">
      <?= htmlspecialchars(implode(', ', (array) $mail_data['usage_days'])) ?> days
    </td>
  </tr>
</table>


<!-- ■ Charge Amount of Voice/Texts -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ Charge Amount of Voice/Texts
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  ※ Outgoing voice/text can be used when the amount is charged, and incoming voice/text is free of charge.
</div>

<div style="text-align: right; font-size: 12px; margin-bottom: 1px;">*VAT is included</div>

<table style="border-collapse: collapse; width: 100%; text-align: center; margin-bottom: 16px;">
  <tr style="background-color: #fff0b3;">
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">Charge amount</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩5,500</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩11,000</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩22,000</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩33,000</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩55,000</td>
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


<!-- ■ SKT Roaming Center at the Airport -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ SKT Roaming Center at the Airport
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
  Please, check the location and working time before visiting the SKT roaming center.
</div>

<table style="width: 100%; border-collapse: collapse; margin-bottom: 16px;">
  <tr>
    <td style="background-color: #e2efd9; border: 1px solid #999; padding: 10px; text-align: left; font-weight: bold;">
      <a href="https://yconnectkorea.com/en_contact/#03" target="_blank" style="color: black; text-decoration: underline;">
        View Details: SKT roaming center
      </a>
    </td>
  </tr>
</table>

<!--■ Online Recharge Amount of Voice/Texts -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-bottom: 1px;">
  ■ Online Recharge Amount of Voice/Texts
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  <strong>Access the charge amount of voice/texts page:</strong>
  <a href="https://www.skroaming.com/reservation/charging" target="_blank">
    https://www.skroaming.com/reservation/charging
  </a>
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  ① Enter login information:<br>
 Rental contract number / USIM 010 phone number (This information will be provided when you pick up your SIM card)
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  ② Decide on recharge amount:<br>
  ₩5,500 / ₩11,000 / ₩22,000 / ₩33,000 / ₩55,000 (VAT is included)
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  ③ Enter Payment Card Information:<br>
  You must pay with your credit card that can be used in Korea.
</div>


<!-- 맺음말 -->
<br>
<hr>
<div class="section-title" style="font-weight: bold; font-size: 14px; line-height: 1.6; margin-top: 16px; margin-bottom: 16px;">
  If there are any errors in your order details, or if you have any questions, 
Please, send an email with your order number and inquiry, and we will respond promptly.
Once again, we sincerely thank you for ordering the Y CONNECT KOREA SKT USIM (Airport Pickup).
</div>

<div class="section-title" style="font-weight: bold; font-size: 14px; line-height: 1.6; margin-top: 16px; margin-bottom: 1px;">
  Y CONNECT KOREA, INC.<br>
  Customer Support
</div>
  <div style="font-size: 14px; margin-bottom: 16px;">
    <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a>
  </div>
</div>
</body>
</html>