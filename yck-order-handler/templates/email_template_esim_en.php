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
  <a href="http://yconnectkorea.com/en/" target="_blank">
    <img src="https://yconnectkorea.com/wp-content/uploads/2025/04/YCK_logo_01.png" alt="Y CONNECT KOREA Logo"
      style="max-width: 200px; display: block; margin: 20px 0;">
  </a>
  
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 16px; font-weight: bold;">
  Thank you very much for ordering the Y CONNECT KOREA SKT eSIM.
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px; font-weight: bold;">
  This guide email has been sent to assist you with your eSIM installation and mobile phone usage in Korea.
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px; font-weight: bold;">
  Once your order is complete, you should receive an email containing a QR code separately from this installation guide email.
</div>

<!-- <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px; color: red; font-weight: bold;">
  If you do not receive the QR code email (in English) from our Korean partner within 24 hours after placing your order:
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px; font-weight: bold;">
  1. Please check your email's spam folder or promotions tab.
</div>

<div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px; font-weight: bold;">
  2. If you still do not receive the QR code after checking the above 1,<br>
  please send an email to <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a> with subject "QR Code Not Received", and include your name, phone number, and order number. We will process your request immediately.
</div> -->


<!-- ■ SKT eSIM 예약번호(주문번호) -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ SKT eSIM Reservation Number (Order Number)
</div>

<table style="border-collapse: collapse; width: 100%; table-layout: fixed; margin-bottom: 1px;">
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; width: 50%; font-size: 14px; line-height: 1.6;">
      Reservation Number<br>(Order Number)
    </td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; width: 50%; font-size: 14px; line-height: 1.6;">
      <?= htmlspecialchars($mail_data['order_id']) ?>
    </td>
  </tr>
</table>




<!-- ■ SKT eSIM 예약 정보-->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ SKT eSIM Reservation Information
</div>

<table style="border-collapse: collapse; width: 100%; table-layout: fixed; margin-bottom: 1px;">
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6;">
      Last Name / First Name
    </td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6;">
      <?= htmlspecialchars($mail_data['last_name']) ?> <?= htmlspecialchars($mail_data['first_name']) ?>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6;">
      Mobile Number
    </td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6;">
      +1 <?= htmlspecialchars($mail_data['mobile_number']) ?>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6;">
      Mobile Model Name
    </td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6;">
      <?= htmlspecialchars($mail_data['device_model']) ?>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6;">
      Arrival Date in Korea
    </td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6;">
      <?= htmlspecialchars($mail_data['arrival_date']) ?>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6; color: red;">
      Pickup / Passport Verification / Charge
    </td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6; color: red;">
      <?= htmlspecialchars($mail_data['pickup_location']) ?>
    </td>
  </tr>
  <tr>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6;">
      Usage Days
    </td>
    <td style="border: 1px solid #000; padding: 12px; text-align: center; vertical-align: middle; font-size: 14px; line-height: 1.6;">
      <?= htmlspecialchars(implode(', ', (array) $mail_data['usage_days'])) ?> days
    </td>
  </tr>
</table>



        <!-- ■ SKT eSIM 설치, 활성화 방법 -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ How to install eSIM
</div>

  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
  ※ This eSIM QR codes can be scanned within one year after the order and it cannot be scanned after one year.  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    ※ If you delete the eSIM profile, you will need to order a new eSIM to use it.
  </div>

<table style="border-collapse: collapse; width: 100%; margin: 16px 0;">
  <tr>
    <td style="background-color: #e2efd9; border: 1px solid #999; padding: 10px; text-align: left; font-weight: bold;">
      <a href="https://yconnectkorea.com/esim-install" target="_blank" style="color: black; text-decoration: underline;">
        View Details: How to install eSIM by scanning QR code and Activate eSIM in Korea
      </a>
    </td>
  </tr>
</table>


<!-- ■ How to Use Incoming/Outgoing Voice/Texts -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ How to Use Incoming/Outgoing Voice/Texts
</div>

  <div style="color: red; font-weight: bold; font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    ※ If you only need data, the following steps are not required.
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    Before arriving in Korea, please install the eSIM on your phone. 
    </div>
    <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    Then, visit the SKT roaming center at the airport.
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    1. Present the QR code email (order number / rental contract number / eSIM 010 phone number)
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    2. Submit your passport to verify passport information.
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    3. Charge the amount for outgoing voice/texts (You must pay with your credit card that can be used in Korea).
  </div>

<!-- ■ Charge Amount of Voice/Texts -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ Charge Amount of Voice/Texts
</div>


  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    ※ Outgoing voice/text can be used when the amount is charged, and incoming voice/text is free of charge.
  </div>

<div style="text-align: right; font-size: 12px; margin-bottom: 1px;">*VAT is included</div>

<table style="border-collapse: collapse; width: 100%; text-align: center;">
  <tr style="background-color: #fff0b3;">
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">Charge amount</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩5,500</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩11,000</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩22,000</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩33,000</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">₩55,000</td>
  </tr>
  <tr style="background-color: #e2efd9;">
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">Minute</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">About 20 minutes</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">About 40 minutes</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">About 80 minutes</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">About 120 minutes</td>
    <td style="border: 1px solid #ccc; border-top: 2px solid #333; padding: 10px;">About 200 minutes</td>
  </tr>
</table>


<!-- ■ SKT Roaming Center at the Airport -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 20px; margin-bottom: 1px;">
  ■ SKT Roaming Center at the Airport
</div>

  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    Please, check the location and working time before visiting the SKT roaming center.
  </div>

<table style="border-collapse: collapse; width: 100%; margin: 16px 0;">
  <tr>
    <td style="background-color: #e2efd9; border: 1px solid #999; padding: 10px; text-align: left; font-weight: bold;">
      <a href="https://yconnectkorea.com/en_contact/#03" target="_blank" style="color: black; text-decoration: underline;">
        View Details: SKT roaming center
      </a>
    </td>
  </tr>
</table>


<!-- ■ Online Passport Information Verification (Only Available for Foreign Passport Holders) -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-bottom: 1px;">
  ■ Online Passport Information Verification (Only Available for Foreign Passport Holders)
</div>

  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    ※ For those using data only, passport information verification is not required.
  </div>
  <div style="font-size: 14px; color: red; font-weight: bold; line-height: 1.6; margin-bottom: 1px;">
    ※ A passport issued by the Republic of Korea cannot be used for online passport information verification.
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    Online passport information verification is available daily from 8:00 AM to 10:00 PM after passing through Korean immigration.
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    <strong>Access the passport information verification page:</strong>
    <a href="https://www.skroaming.com/passport/" target="_blank">https://www.skroaming.com/passport/</a>
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    ① Enter login information:<br>
    Rental contract number / eSIM 010 phone number (This information will be provided on your QR code email)
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    ② Enter your passport information:<br>
    Last name / First name / Passport number / Date of birth / Nationality (must match the information on your passport)
  </div>


<!-- ■ Online Charge Amount of Voice/Texts -->
<div class="section-title" style="font-weight: bold; font-size: 14px; margin-top: 16px; margin-bottom: 1px;">
  ■ Online Charge Amount of Voice/Texts
</div>

  <div style="font-size: 14px; color: red; font-weight: bold; line-height: 1.6; margin-bottom: 1px;">
    ※ Only customers who have completed passport information verification can charge online.
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    <strong>Access the charge amount of voice/texts page:</strong>
    <a href="https://www.skroaming.com/reservation/charging" target="_blank">
      https://www.skroaming.com/reservation/charging
    </a>
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    ① Enter login information:<br>
    Rental contract number / eSIM 010 phone number (This information will be provided on your QR code email)
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    ② Decide on charge amount:<br>
    ₩5,500 / ₩11,000 / ₩22,000 / ₩33,000 / ₩55,000 (VAT is included)
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    ③ Enter Payment Card Information:<br>
    You must pay with your credit card that can be used in Korea.
  </div>

<br>
<hr style="margin: 16px 0;">


<!-- 맺음말 -->
<div class="section-title" style="font-weight: bold; font-size: 14px; line-height: 1.6;">
If there are any errors in your order details, or if you have any questions, 
please send an email with your order number and inquiry, and we will respond promptly.
Once again, we sincerely thank you for ordering the Y CONNECT KOREA SKT eSIM.
</div>

  <div class="section-title" style="font-weight: bold; font-size: 14px; line-height: 1.6; margin-bottom: 1px;">
    Y CONNECT KOREA<br>
    Customer Support
  </div>
  <div style="font-size: 14px; line-height: 1.6; margin-bottom: 16px;">
    <a href="mailto:contact@yconnectkorea.com">contact@yconnectkorea.com</a>
  </div>

</body>

</html>